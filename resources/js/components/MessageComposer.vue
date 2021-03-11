<template>
    <label>
        <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
    </label>
</template>

<script>
export default {
    data() {
        return {
            message: ''
        };
    },
    methods: {
        send(e) {
            e.preventDefault();
            if (this.message !== '') {
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    textarea {
        width: 96%;
        margin: 10px;
        resize: none;
        border-radius: 10px;
        border: 1px solid lightgray;
        padding: 6px;
    }
</style>
