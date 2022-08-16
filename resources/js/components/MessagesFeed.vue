<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to === contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        }
    },
    methods: {
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        }
    },
    watch: {
        contact(contact) {
            this.scrollToBottom();
        },
        messages(messages) {
            this.scrollToBottom();
        }
    }
}
</script>

<style lang="scss" scoped>
    .feed {
        background: #fffaf5;
        height: 350px;
        overflow: scroll;
        overflow-x: hidden;

        ul {
            list-style-type: none;
            padding: 5px;

            li {
                &.message {
                    margin: 10px 0;
                    width: 100%;

                    .text {
                        max-width: 200px;
                        border-radius: 10px;
                        padding: 12px;
                        display: inline-block;
                    }

                    &.received {
                        text-align: right;

                        .text {
                            background: #ffa726;
                        }
                    }

                    &.sent {
                        text-align: left;

                        .text {
                            background: #81c4f9;
                        }
                    }

                }

            }
        }
    }
</style>
