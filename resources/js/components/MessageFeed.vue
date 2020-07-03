<template>
    <div class="chat" id="chat" ref="feed" style="height:420px">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == curent_usert ? ' left-message' : ' right-message'}`" :key="message.id" >
                <div class="messages-title" v-if="message.date &&  message.date!=0 && message.date!=='today'"><b>{{message.date}}</b></div>
                <div class="messages-title" v-if="message.date &&   message.date==='today'"><b>Новое сообщение</b></div>
                <div class="time" style="margin-right: 12px">{{message.time}}</div>
                <div class="text" :class="message.to==curent_usert ? ' sent' : ' received'">
                    <p v-if="message.flag==1">Сообщение удалено.</p>
                    <div v-else>
                    <img class="del-msg"  @click="deleteMes(message)" style="margin-right: 12px" src="/asset/front/images/close.png" >
                    <p :id="'ms_'+message.id" v-html="message.text"></p>
                    <span :id="'ms_i' + message.id"  v-if="message.read==0 && message.to==contact.id" >Не прочтено</span>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
props:{
    contact:{
        type:Object,

    },
    messages:{
        type:Array,
        required:true,
    }
},
        data(){
               return {

                   ms:'',
                   curent_usert:document.querySelector("meta[name='user-id']").getAttribute('content')
               }
        },

        mounted(){

        }
 ,
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
            deleteMes(message){
                axios.post('/message/delete',{
                    message:message,
                }).then(

                    document.querySelector("#ms_"+message.id).innerHTML="Сообщение удалено."
                );


            },
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();

            },
            messages(messages) {
                this.scrollToBottom();

            if (messages.length!=0){
                   this.ms=messages[messages.length - 1];
                    if(this.ms){
                        if (this.ms.to==document.querySelector("meta[name='user-id']").getAttribute('content')) {
                            axios.post('/read',{
                                ms_id:messages[messages.length - 1].id,
                                from:messages[messages.length - 1].from
                            });
                        }
                   }


                }





            }
        }

    }
</script>

<style lang="scss" scoped>


</style>