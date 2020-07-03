<template>
    <div class="left-sms">
        <div class="sms-if-online wmOnlFilter nomar">
            <input type="checkbox" v-model="is_online" id="choice-1" name="choice-1"> <!-- checked="" -->
            <label for="choice-1">ОНЛАЙН</label>


            <img id="voice_off" v-if="this.sound_flag==true" @click="chengeSong()" src="/asset/front/images/speaker.png">
            <img id="voice_on" v-if="this.sound_flag==false" @click="chengeSong()"  src="/asset/front/images/speakeroff.png" >
            <!--<div id="speaker_off_on_button" class="speaker_on_button"></div>-->
        </div>


        <div v-if="dial_show" id="close-user-in-dialog" style="position: absolute;width: 80%">
            <p> Вы уверены, что хотите удалить контакт из чата?"</p>
            <p><input v-model="del_chat" type="checkbox" name="del_history">&nbsp;Очистить историю ?</p>
            <p><input v-model="black_list" type="checkbox" name="add_ban">&nbsp;Добавить в черный список ?</p>
            <a class="butt" @click="deleteOk(deletecontact)">ок</a>
            <a class="butt" @click="cancelOk()">отмена</a>
        </div>
        <div class="ul">
            <div class="sms-contact" v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)"
                 :class="{'selected':contact==selected,online_user:(contact.is_onl==1),offline_user :(contact.is_onl!=1 && is_online==true) }">

                <div class="contact-photo">
                    <img class="contact-person-photo"
                         :src='contact ? "/storage/avatar/"+contact.person.avatar : "/storage/avatar/default.png"'
                         :alt="contact.name">
                    <!-- Если статус офлайн  -->
                    <img v-if="contact.is_onl==1" class="status" src="/asset/front/images/contact-online.png">
                    <img v-if="contact.is_onl==0" class="status" src="/asset/front/images/contact-offline.png">
                </div>
                <div class="contact-info" get-count_m="0">
                    <span class="contact-info-name">{{contact.name}}<img @click="deleteContact(contact)"
                                                                         class="clear-msg"
                                                                         src="/asset/front/images/close.png"></span>
                    <!-- Если пользователь пишет сообщение в данный момент -->
                    <div class="contact-info--writing" :id="'user_'+contact.id" style="display: none;">
                        Печатает...
                        <img src="/asset/front/images/pen-edit.png" alt="">
                    </div>
                    <div class="contact-info--new-message" v-if="contact.unread">
                        <span class="green-span">{{contact.unread}}</span>
                        <img src="/asset/front/images/sms-count.png">
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {

            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                deletecontact: 0,
                dial_show: false,
                del_chat: false,
                black_list: false,
                is_online: false,
                sound_flag:true
            }
        },
        methods: {

            deleteContact(contact) {
                this.deletecontact = contact.id;
                this.dial_show = true;
            },

            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact)
            },
            cancelOk() {
                this.dial_show = false;
            },
            deleteOk(id) {
                var delet;
                var blist;
                if (this.del_chat) {
                    delet = 1;

                }
                else {
                    delet = 0;

                }
                if (this.black_list) {
                    blist = 1;

                }
                else {
                    blist = 0;

                }
                axios.post('/contact/delete', {
                    contact_id: id,
                    black_list: blist,
                    del_chat: delet
                }).then(
                    location.reload(0)
                );

            },
            chengeSong(){
                if(this.sound_flag){
                    this.sound_flag=false
                    this.$emit('flags', this.sound_flag);
                }
                else{
                    this.sound_flag=true
                }
            },
            flagOnlineContact(){

                if(this.is_online){

                    document.getElementById(".offline_user").style.display = "none"
                }
                else {

                    document.getElementById(".offline_user").style.display = "none"
                }
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }]).reverse();
            }
        },

        watch: {
            is_online( is_online)
            {
                this.flagOnlineContact();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .butt {
        box-sizing: border-box;
        color: #000;
        border: 1px solid #918a8a;
        padding: 2px;
    }
    .offline_user{
        display: none;
    }

</style>