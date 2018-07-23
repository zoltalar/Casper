<template>
    <div class="btn-group d-block">
        <a class="btn btn-light" data-toggle="collapse"><i class="fa fa-calendar mr-1"></i> {{ dateRange }}</a>
    </div>
</template>
<script>
    import moment from 'moment'

    export default {
        data() {
            return {
                start: this.startDate,
                end: this.endDate
            }
        },
        props: {
            startDate: {
                default() {
                    return moment().subtract(3, 'days');
                }
            },
            endDate: {
                default() {
                    return moment();
                }
            },
            startTarget: {
                type: String,
                required: false
            },
            endTarget: {
                type: String,
                required: false
            }
        },
        computed: {
            dateRange() {
                let format = 'MM/DD/YYYY';
                let start = this.start.format(format);
                let end = this.end.format(format);

                return start + ' - ' + end;
            }
        },
        mounted() {
            let that = this;

            this.$nextTick(() => {
                window.$(this.$el)
                    .daterangepicker()
                    .on('apply.daterangepicker', function (e, picker) {
                        that.$emit('apply', picker.startDate, picker.endDate);
                        that.start = picker.startDate;
                        that.end = picker.endDate;

                        let format = 'YYYY-MM-DD HH:mm:ss';

                        if (that.startTarget) {
                            $(that.startTarget).val(picker.startDate.format(format));
                        }
                        if (that.endTarget) {
                            $(that.endTarget).val(picker.endDate.format(format));
                        }
                    });
            });
        }
    }
</script>