<template>
    <div class="sender">
        <p v-if="this.flag_typing"> {{this.flag_typing}} печатает .....</p>
        <textarea v-model="message"  @keydown="typing"  @keydown.enter="send"   @focus="onFocus" @blur="onBlur"  class='text-area' placeholder="Для отправки сообщения нажмите enter" rows="5" type='text'></textarea>
        <input type="button"  v-on:click="showBox()" id="btnSmile" value="" class="button">
        <input type="button"  @click="send()" id="btnSend" value="" class="button">
        <div id="smileBox" v-if='seen' >
            <img class="closeSmileBox" src="/asset/front/images/close.png" v-on:click="hideBox()"/>
            <img  :src="this.img_url+'air_kiss.gif'"  imgcode="air_kiss" v-on:click="smileSet(':air_kiss:')" class="smile-box-img" title="air_kiss" />
            <img   :src="this.img_url+'bad.gif'"  imgcode="bad"  class="smile-box-img" title="bad" v-on:click="smileSet(':bad:')" />
            <img :src="this.img_url+'biggrin.gif'" v-on:click="smileSet(':biggrin:')" class="smile-box-img" title="biggrin" />
            <img :src="this.img_url+'blum1.gif'" imgcode="blum1" v-on:click="smileSet(':blum1:')" class="smile-box-img" title="blum1" />
            <img :src="this.img_url+'blush.gif'" imgcode="blush" v-on:click="smileSet(':blush:')" class="smile-box-img" title="blush" />
            <img :src="this.img_url+'bomb.gif'" imgcode="bomb" v-on:click="smileSet(':bomb:')" class="smile-box-img" title="bomb" />
            <img :src="this.img_url+'bye2.gif'" imgcode="bye2" v-on:click="smileSet(':bye2:')" class="smile-box-img" title="bye2" />
            <img :src="this.img_url+'cool.gif'" imgcode="cool" v-on:click="smileSet(':cool:')" class="smile-box-img" title="cool" />
            <img :src="this.img_url+'crazy.gif'" imgcode="crazy"  v-on:click="smileSet(':crazy:')" class="smile-box-img" title="crazy" />
            <img :src="this.img_url+'cry.gif'" imgcode="cry" v-on:click="smileSet(':cry:')" class="smile-box-img" title="cry" />
            <img :src="this.img_url+'dance.gif'" imgcode="dance" v-on:click="smileSet(':dance:')" class="smile-box-img" title="dance" />
            <img :src="this.img_url+'diablo.gif'" imgcode="diablo" v-on:click="smileSet(':diablo:')" class="smile-box-img" title="diablo" />
            <img :src="this.img_url+'drinks.gif'" imgcode="drinks" v-on:click="smileSet(':drinks:')" class="smile-box-img" title="drinks" />
            <img :src="this.img_url+'gamer.gif'" imgcode="gamer"  v-on:click="smileSet(':gamer:')" class="smile-box-img" title="gamer" />
            <img :src="this.img_url+'girl_angel.gif'" imgcode="girl_angel" v-on:click="smileSet(':girl_angel:')" class="smile-box-img" title="girl_angel" />
            <img :src="this.img_url+'give_heart.gif'" imgcode="give_heart" v-on:click="smileSet(':give_heart:')" class="smile-box-img" title="give_heart" />
            <img :src="this.img_url+'give_rose.gif'" imgcode="give_rose" v-on:click="smileSet(':give_rose:')" class="smile-box-img" title="give_rose" />
            <img :src="this.img_url+'good.gif'" imgcode="good" v-on:click="smileSet(':good:')" class="smile-box-img" title="good" />
            <img :src="this.img_url+'hang1.gif'" imgcode="hang1" v-on:click="smileSet(':hang1:')" class="smile-box-img" title="hang1" />
            <img :src="this.img_url+'hi.gif'" imgcode="hi" v-on:click="smileSet(':hi:')" class="smile-box-img" title="hi" />
            <img :src="this.img_url+'ireful.gif'" imgcode="ireful" v-on:click="smileSet(':ireful:')" class="smile-box-img" title="ireful" />
            <img :src="this.img_url+'i_am_so_happy.gif'"  v-on:click="smileSet(':i_am_so_happy:')" imgcode="i_am_so_happy" class="smile-box-img" title="i_am_so_happy" />
            <img :src="this.img_url+'kiss.gif'" imgcode="kiss" v-on:click="smileSet(':kiss:')" class="smile-box-img" title="kiss" />
            <img :src="this.img_url+'kiss3.gif'" imgcode="kiss3" v-on:click="smileSet(':kiss3:')" class="smile-box-img" title="kiss3" />
            <img :src="this.img_url+'lol.gif'" imgcode="lol" v-on:click="smileSet(':lol:')" class="smile-box-img" title="lol" />
            <img :src="this.img_url+'mad.gif'" imgcode="mad" v-on:click="smileSet(':mad:')" class="smile-box-img" title="mad" />
            <img :src="this.img_url+'man_in_love.gif'" v-on:click="smileSet(':man_in_love:')" imgcode="man_in_love" class="smile-box-img" title="man_in_love" />
            <img :src="this.img_url+'mocking.gif'"  v-on:click="smileSet(':mocking:')" imgcode="mocking" class="smile-box-img" title="mocking" />
            <img :src="this.img_url+'music.gif'" v-on:click="smileSet(':music:')" imgcode="music" class="smile-box-img" title="music" />
            <img :src="this.img_url+'nea.gif'"  v-on:click="smileSet(':nea:')"imgcode="nea" class="smile-box-img" title="nea" />
            <img :src="this.img_url+'pardon.gif'" v-on:click="smileSet(':pardon:')" imgcode="pardon" class="smile-box-img" title="pardon" />
            <img :src="this.img_url+'rofl.gif'" v-on:click="smileSet(':rofl:')" imgcode="rofl" class="smile-box-img" title="rofl" />
            <img :src="this.img_url+'sad.gif'" v-on:click="smileSet(':scratch_one-s_head:')" imgcode="sad" class="smile-box-img" title="sad" />
            <img :src="this.img_url+'scratch_one-s_head.gif'"  v-on:click="smileSet(':scratch_one-s_head:')"imgcode="scratch_one-s_head" class="smile-box-img" title="scratch_one-s_head" />
            <img :src="this.img_url+'shok.gif'" imgcode="shok" v-on:click="smileSet(':shok:')" class="smile-box-img" title="shok" />
            <img :src="this.img_url+'shout.gif'" imgcode="shout" v-on:click="smileSet(':shout:')" class="smile-box-img" title="shout" />
            <img :src="this.img_url+'smile.gif'" imgcode="smile" v-on:click="smileSet(':smile:')" class="smile-box-img" title="smile" />
            <img :src="this.img_url+'sorry.gif'" imgcode="sorry" v-on:click="smileSet(':sorry:')" class="smile-box-img" title="sorry" />
            <img :src="this.img_url+'unknown.gif'" imgcode="unknown" v-on:click="smileSet(':unknown:')" class="smile-box-img" title="unknown" />
            <img :src="this.img_url+'wacko1.gif'" imgcode="wacko1" class="smile-box-img" v-on:click="smileSet(':wacko1:')" title="wacko1" />
            <img :src="this.img_url+'wink.gif'" imgcode="wink" class="smile-box-img" v-on:click="smileSet(':wink:')" title="wink" />
            <img :src="this.img_url+'yahoo.gif'" imgcode="yahoo" class="smile-box-img" v-on:click="smileSet(':yahoo:')" title="yahoo" />
            <img :src="this.img_url+'yes.gif'" imgcode="yes" class="smile-box-img" v-on:click="smileSet(':yes:')" title="yes" />
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            contact: {
                type: Object,

            },
            flag_typing:{
                default:null,
            }
        },
        data() {
            return {
                typing_count:0,
                typing_count_block:0,
                focused: false,
                message: '',
                input: '',
                search: '',
                seen:false,
                img_url:'/asset/front/images/smiles/'

            }
        },

        methods: {
            onFocus() {
                this.focused = true

            },
            onBlur() {
                this.focused = false
                this.typing_count=0;
                this.typing_count_block=0

            },
            smileSet: function (smile) {

                this.message=' '+this.message+smile+' ';
            },
        hideBox(){
               this.seen=false
              },
            showBox(){

                this.seen=true
            },
            send() {
                this.typing_count=0;
                this.typing_count_block=0
                if (this.message == '') {
                    return;
                }

                this.message=this.message.replace(new RegExp(':air_kiss:', 'g'),'<img src="'+ this.img_url+'air_kiss.gif"/>' );

                //this.message= this.message.replace(':air_kiss:', '<img src="'+ this.img_url+'air_kiss.gif"/>');
               // this.message= this.message.replace(':air_kiss:', '<img src="'+ this.img_url+'air_kiss.gif"/>');
                this.message=this.message.replace(new RegExp(':bad:', 'g'),'<img src="' + this.img_url+'bad.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':biggrin:', 'g'),'<img src="'+this.img_url+'biggrin.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':blum1:', 'g'),'<img src="'+this.img_url+'blum1.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':blush:', 'g'),'<img src="'+this.img_url+'blush.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':bomb:', 'g'),'<img src="'+this.img_url+'bomb.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':bye2:', 'g'), '<img src="'+this.img_url+'bye2.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':cool:', 'g'), '<img src="'+this.img_url+'cool.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':crazy:', 'g'), '<img src="'+this.img_url+'crazy.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':cry:', 'g'), '<img src="'+this.img_url+'cry.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':dance:', 'g'), '<img src="'+this.img_url+'dance.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':diablo:', 'g'), '<img src="'+this.img_url+'diablo.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':drinks:', 'g'), '<img src="'+this.img_url+'drinks.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':gamer:', 'g'), '<img src="'+this.img_url+'gamer.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':girl_angel:', 'g'),'<img src="'+this.img_url+'girl_angel.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':give_heart:', 'g'),'<img src="'+this.img_url+'give_heart.gif'+'"/>' );
                this.message=this.message.replace(new RegExp(':give_rose:', 'g'),'<img src="'+this.img_url+'give_rose.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':good:', 'g'),'<img src="'+this.img_url+'good.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':hang1:', 'g'),'<img src="'+this.img_url+'hang1.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':hi:', 'g'),'<img src="'+this.img_url+'hi.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':ireful:', 'g'),'<img src="'+this.img_url+'ireful.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':i_am_so_happy:', 'g'),'<img src="'+this.img_url+'i_am_so_happy.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':kiss:', 'g'),'<img src="'+this.img_url+'kiss.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':kiss3:', 'g'),'<img src="'+this.img_url+'kiss3.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':lol:', 'g'),'<img src="'+this.img_url+'lol.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':mad:', 'g'),'<img src="'+this.img_url+'mad.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':man_in_love:', 'g'),'<img src="'+this.img_url+'man_in_love.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':mocking:', 'g'),'<img src="'+this.img_url+'mocking.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':music:', 'g'),'<img src="'+this.img_url+'music.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':nea:', 'g'),'<img src="'+this.img_url+'nea.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':mpardon:', 'g'),'<img src="'+this.img_url+'pardon.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':rofl:', 'g'),'<img src="'+this.img_url+'rofl.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':sad:', 'g'),'<img src="'+this.img_url+'sad.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':scratch_one-s_head:', 'g'),'<img src="'+this.img_url+'scratch_one-s_head.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':shok:', 'g'),'<img src="'+this.img_url+'shok.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':shout:', 'g'),'<img src="'+this.img_url+'shout.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':smile:', 'g'),'<img src="'+this.img_url+'smile.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':sorry:', 'g'),'<img src="'+this.img_url+'sorry.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':unknown:', 'g'),'<img src="'+this.img_url+'unknown.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':wacko1:', 'g'),'<img src="'+this.img_url+'wacko1.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':wink:', 'g'),'<img src="'+this.img_url+'wink.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':yahoo:', 'g'),'<img src="'+this.img_url+'yahoo.gif'+'"/>');
                this.message=this.message.replace(new RegExp(':yes:', 'g'),'<img src="'+this.img_url+'yes.gif'+'"/>');





                this.$emit('send', this.message)
                this.message = "";
            },
            typing(){

                if( this.focused==true && this.typing_count<15) {


                    Echo.private('typingevent')
                        .whisper('typing', {
                            'user': authuser,
                            'typing': this.message,
                            'userId': this.contact.id
                        });

                     this.typing_count++;
                }

                if(this.typing_count==15)
                {
                    this.typing_count_block++;

                    if(this.typing_count_block>15)
                    {
                        this.typing_count=0;
                        this.typing_count_block=0;
                    }

                }
            }

        },


    }
</script>

<style lang="scss" scoped>
    /* Tailwind CSS-styled demo is available here: https://codepen.io/DCzajkowski/pen/Brxvzj */


</style>