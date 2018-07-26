<template>
    <div class="btn-group d-block">
        <a class="btn btn-light" data-toggle="collapse"><i class="fa fa-calendar mr-1"></i> {{ dateRange }}</a>
    </div>
</template>
<script>
    import axios from 'axios'
    import moment from 'moment'

    export default {
        data() {
            return {
                start: this.startDate,
                end: this.endDate,
                invalidDates: null
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
            },
            invalidDatesSource: {
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
        methods: {
            url() {
                return this.invalidDatesSource;
            }
        },
        created() {
            let url = this.url();

            if (url) {
                axios
                    .get(url)
                    .then(response => {
                        this.invalidDates = response.data;
                    });
            }
        },
        mounted() {
            let that = this;

            this.$nextTick(() => {
                window.$(this.$el)
                    .daterangepicker({
                        isInvalidDate(date) {
                            return $.inArray(date.format('YYYY-MM-DD'), (that.invalidDates || [])) !== -1;
                        }
                    })
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