<template>
    <div class="btn-group">
        <a class="btn btn-default" data-toggle="collapse">{{ dateRange }}</a>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                start: this.startDate,
                end: this.endDate,
                format: 'MM/DD/YYYY'
            }
        },
        props: {
            startDate: {
                default() {
                    return moment().subtract(7, 'days');
                }
            },
            endDate: {
                default() {
                    return moment();
                }
            }
        },
        computed: {
            dateRange() {
                let start = this.start.format(this.format);
                let end = this.end.format(this.format);

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
                    });
            });
        }
    }
</script>