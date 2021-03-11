<template>
    <div class="conversation">
        <h1 id="contactName">{{ contact ? contact.name : 'Select a contact' }}</h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                defautl: []
            }
        },
        methods: {
            sendMessage(text) {
                if(this.contact) {
                    axios.post('conversation/send', {
                        contact_id: this.contact.id,
                        text: text
                    }).then((response) => {
                        this.$emit('new', response.data);
                    })
                }
            }
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>
