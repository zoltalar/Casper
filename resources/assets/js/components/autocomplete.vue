<template>
    <div class="auto-complete btn-group">
        <input type="text" class="form-control" v-model="phrase" @keyup="load()">
        <input type="hidden" name="id" v-model="id">
        <div class="dropdown-menu" :class="{ 'show': open }">
            <a href="#" class="dropdown-item" v-for="(item, i) in items" @click="pick(i, $event)">{{ item.name }}</a>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                id: null,
                index: null,
                phrase: '',
                open: false,
                items: [],
                timer: null
            }
        },
        props: {
            source: {
                type: String,
                required: true
            }
        },
        methods: {
            load() {
                let that = this;
                if (this.timer != null) {
                    clearTimeout(this.timer);
                }
                this.timer = setTimeout(function() {
                    axios
                        .get(that.url())
                        .then(response => {
                            that.items = response.data
                        });
                }, 500);
            },
            url() {
                return this.source + '?phrase=' + encodeURIComponent(this.phrase);
            },
            pick(index, event) {
                event.preventDefault();

                if (this.items[index]) {
                    let item = this.items[index];

                    this.index = index;
                    this.id = item.id;
                    this.open = false;
                    this.phrase = item.name;
                }
            }
        },
        watch: {
            items: function(_items) {
                this.open = (_items.length > 0);
            },
            phrase: function(_phrase) {
                if (_phrase == '') {
                    this.id = null;
                }
            }
        }
    }
</script>