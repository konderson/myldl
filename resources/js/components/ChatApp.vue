<template>
    <div id="chat_contener">
        <ContactList :contacts="contacts" @flags="soundFlag" @selected="startConversationWith"/>
        <Conversation :contact="selectedContact" :messages="messages"   :flag_typing="typing" @new="saveNewMessage"/>

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
                sound_flag:true,
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


            Echo.private(`delmessage.${this.user.id}`)
                .listen('DeleteMessage', (e) => {
                    document.querySelector("#ms_"+e.message.id).innerHTML="Сообщение удалено."

                });

            Echo.private('typingevent')
                .listenForWhisper('typing', (e) => {
                    document.getElementById('user_'+e.user.id).style.display = "block";
                    if (this.selectedContact != null)
                    {
                    if (authuser.id == e.userId  && this.selectedContact.id==e.user.id) {
                        this.typing = e.user.name;


                    }
                   }
                    setTimeout(() => {
                        this.typing = '';
                        document.getElementById('user_'+e.user.id).style.display = "none";
                    }, 5000);
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
               if(this.sound_flag==true) {
                   if (audio) {
                       audio.play();
                   }
               }
            },
            soundFlag(flag){
              this.sound_flag=flag
            },

            startConversationWith(contact) {
              //  this.updateUnreadCount(contact, true);
                this.updateUnreadCount(contact,true);
                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        console.log(response.data);
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