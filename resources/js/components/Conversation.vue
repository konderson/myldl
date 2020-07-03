<template>
    <div class="right-sms">
        <div class="contact-photo"><img :src='contact ? "/storage/avatar/"+contact.person.avatar : "/storage/avatar/default.png"'>
            <span class="name"><a class="user-anketa" href="https://myldl.ru/users/user_dela/">{{ contact ? contact.name : 'Виберите контакт .' }}</a></span>
        </div>
        <MessageFeed :contact="contact" :messages="messages"/>
        <MessageComposer  :flag_typing="flag_typing"  :contact="contact" @send="sendMessage" />
</div>
</template>

<script>
    import MessageFeed from './MessageFeed';
    import MessageComposer from './MessageComposer';
    export default {
        mounted(){
            console.log(this.contact)
        },
        props: {
            contact: {
                type: Object,
                default: null
            },
            flag_typing:{
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }
                axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            }
        },

        components: {MessageFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>

</style>