<template>
    <div class="auto-complete btn-group">
        <input type="text" class="form-control" v-model="phrase" @keydown="load($event)" @keydown.enter="pick(index, $event);" @keydown.up="previous()" @keydown.down="next()">
        <input type="hidden" name="id" v-model="id">
        <div class="dropdown-menu" :class="{ 'show': open }">
            <a href="#" class="dropdown-item" :class="{ 'active': (i == index) }" v-for="(item, i) in items" @click="pick(i, $event)">{{ item.name }}</a>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                id: null,
                index: -1,
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
            load(event) {
                if (event.keyCode == 13) {
                    return false;
                }
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
            },
            next() {
                if (this.count > 0) {
                    this.index++;

                    if (this.index > this.count - 1) {
                        this.index = this.count - 1;
                    }
                }
            },
            previous() {
                if (this.count > 0) {
                    this.index--;

                    if (this.index < 0) {
                        this.index = 0;
                    }
                }
            },
            close() {
                let that = this;
                setTimeout(function() {
                    that.open = false;
                }, 100);
            }
        },
        computed: {
            count: function() {
                return this.items.length;
            }
        },
        watch: {
            items: function(_items) {
                this.open = (_items.length > 0);

                if (this.items.length != _items.length) {
                    this.index = -1;
                }
            },
            phrase: function(_phrase) {
                if (_phrase == '') {
                    this.id = null;
                }
            }
        }
    }
</script>