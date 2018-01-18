<template>
    <div class="btn-group">
        <input type="text" class="form-control" v-model="phrase" @keyup="load()">
        <input type="hidden" name="id" v-model="id">
        <div class="dropdown-menu" :class="{ 'show': open }">
            <a href="#" class="dropdown-item" v-for="(item, index) in items" @click="pick(index)">{{ item.name }}</a>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import _ from 'underscore'

    export default {
        data() {
            return {
                id: null,
                index: null,
                phrase: '',
                open: false,
                items: []
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
                setTimeout(function() {
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
            pick(index) {
                if (this.items[index]) {
                    let item = this.items[index];

                    this.index = index;
                    this.id = item.id;
                    this.open = false;
                    this.phrase = item.name;
                }
                return false;
            }
        },
        watch: {
            items: function(newItems) {
                this.open = (newItems.length > 0);
            }
        }
    }
</script>