<template>
    <div class="left-sms">
        <div class="sms-if-online wmOnlFilter nomar">
            <input type="checkbox" id="choice-1" name="choice-1"> <!-- checked="" -->
            <label for="choice-1">ОНЛАЙН</label>

            <audio id="play_new_msg" src="https://myldl.ru/application/views/front/chat/sounds/ws_sound_msg.wav">

            </audio>
            <img id="voice_off" src="/static/images/speaker.png">
            <img id="voice_on" src="/static/images/speakeroff.png" style="display:none">
            <!--<div id="speaker_off_on_button" class="speaker_on_button"></div>-->
        </div>


        <div id="close-user-in-dialog" title="Вы уверены, что хотите удалить контакт из чата?" style="display: none;">
            <p><input type="checkbox" name="del_history">&nbsp;Очистить историю ?</p>
            <p><input type="checkbox" name="add_ban">&nbsp;Добавить в черный список ?</p>
        </div>
        <div class="ul">
            <div class="sms-contact"  v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{'selected':contact==selected}"id="21998">

                <div class="contact-photo">
                    <img class="contact-person-photo" :src="contact.profile_img" :alt="contact.name">
                    <!-- Если статус офлайн  -->
                    <img class="status" get-is_online="0" src="/static/images/contact-offline.png">
                </div>
                <div class="contact-info" get-count_m="0">
                    <span class="contact-info-name">{{contact.name}}<img class="clear-msg" src="/static/images/close.png"></span>
                    <!-- Если пользователь пишет сообщение в данный момент -->
                    <div class="contact-info--writing" style="display: none;">
                        Печатает...
                        <img src="/static/images/pen-edit.png" alt="">
                    </div>
                    <span class="unrad" v-if="contact.unread">{{contact.unread}}</span>

                </div>
            </div>
           </div>
    </div>
</template>

<script>
    export default {
        props:{
            contacts:{
                type:Array,
                default:[]
            }
        },
        data(){
            return {
                selected:this.contacts.length ? this.contacts[0]:null
            }
        },
        methods:{
            selectContact(contact){
                this.selected=contact;
                this.$emit('selected',contact)
            }
        },
        computed:{
            sortedContacts(){
              return _.sortBy(this.contacts,[(contact)=>{
                  if(contact==this.selected){
                      return Infinity;
                  }
                  return contact.unread;
              }]).reverse() ;
            }
        }
    }
</script>

<style lang="scss" scoped>



</style>