<template>
    <div class="alert alert-dismissible" v-show=" ! hidden">
        <slot></slot>
        <button class="close" v-on:click="close">
            <span>&times;</span>
        </button>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                hidden: false
            }
        },
        methods: {
            close() {
                this.hidden = true;
            }
        }
    }
</script>