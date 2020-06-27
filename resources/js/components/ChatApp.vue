<template>
    <div id="chat_contener">
        <Conversation :contact="selectedContact" :messages="messages"   :flag_typing="typing" @new="saveNewMessage"/>
        <ContactList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';
    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                typing:'',
            };
        },
        mounted() {


            console.log(document.querySelector("meta[name='user-id']").getAttribute('content'))
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    //alert('ii')
                    this.hanleIncoming(e.message);
                    this.playEvent();

                });

            Echo.private('typingevent')
                .listenForWhisper('typing', (e) => {
                    if (this.selectedContact != null)
                    {
                    if (authuser.id == e.userId  && this.selectedContact.id==e.user.id) {
                        this.typing = e.user.name;


                        /*setTimeout(() => {
                            this.typing = '';}, 2000);*/
                    }
                   }
                });
           Echo.private(`read.${this.user.id}`)
                .listen('ReadCheck', (e) => {
                    //alert(e.ms_id);
                   if(document.getElementById('ms_i'+e.ms_id)) {
                       document.getElementById('ms_i'+e.ms_id).innerHTML="Прочтено";
                   }


                });
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                    console.log(response.data)
                });

        },
        methods: {

            playEvent(){
                const audio = new Audio('/sound/1.mp3');

                if (audio) {
                    audio.play();
                }
            },
            startConversationWith(contact) {
              //  this.updateUnreadCount(contact, true);
                this.updateUnreadCount(contact,true);
                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
console.log(message.to)
                this.messages.push(message);

            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
               // this.updateUnreadCount(message.from_contact, false);
                this.updateUnreadCount(message.from_contact,false);
            },
            updateUnreadCount(contact,reset){
                this.contact=this.contacts.map((single)=>{
                    if (single.id !=contact.id) {
                        return single;
                    }
                    if(reset){
                        if(single.unread!=0){

                            single.unread=0;
                          /*  axios.get('/read/'+single.id)
                                .then((response) => {

                                     console.log("send read")
                                });*/


                        }

                    }
                    else{
                        single.unread+=1;
                    }
                    })
            }
            /*updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }
                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;
                    return single;
                })
            }*/
        },
        components: {Conversation, ContactList}
    }
</script>


<style lang="scss" scoped>

</style>