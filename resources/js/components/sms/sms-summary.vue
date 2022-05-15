<template>
    <div>
        <div class="shadow overflow-visible rounded-sm w-112 border-t-4 mb-2 mr-4 sm:mr-0 border-accent-600">
            <form :action="formAction" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <input v-if="sms.id" type="hidden" :value="sms.id" name="id">
                <div class="relative bg-white px-4 pb-3 space-y-5 sm:p-6">
                    <input type="hidden" :value="orderNo" name="order_no">
                    <!---Sender-->
                    <div class="flex">
                        <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                            <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold ml-3 self-center text-gray-600">{{ senderName }}</h3>
                        <input type="hidden" ref="sender" name="sender">
                    </div>
                    <!---Text--->
                    <div class="flex">
                        <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                            <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div class="ml-3 pl-2 p-1 w-80 h-24 bg-gray-200 border-gray-400 border-2">
                            <p class="font-medium text-gray-800 text-sm">{{ messageText }}</p>
                        </div>
                        <input type="hidden" ref="message" name="message">
                    </div>
                    <!---Recipients--->
                    <div class="flex mt-1"> 
                        <div class="flex justify-center bg-primary-200 rounded-full h-8 w-8">
                            <svg class="flex-shrink-0 h-4 w-4 self-center text-primary-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="leading-5 text-sm text-gray-600 self-center ml-3 ">
                            <span class="text-base font-semibold">"{{ messagingList.name + '" '}}</span> has
                            <span class="text-3xl font-extralight">{{ messagingList.entries }}</span> recipients
                        </p>
                        <input type="hidden" ref="recipientsListId" name="recipient_list_id">
                    </div>
                    <!--send options-->
                    <fieldset class="ml-9 w-80 border border-accent-900 rounded-md">
                        <div class="rounded-md cursor-pointer">
                            <div v-if="sms.status !== 'pending'" class="pl-4 py-2 flex items-center rounded-t-md" :class="!sendLater ? 'bg-accent-100':'bg-white'">
                                <input @input="setSendNow()" id="send_now" value="now" :checked="!sendLater" name="sending_time" type="radio" class="h-4 w-4 text-accent-800 focus:ring-2 focus:ring-accent-800 border-gray-300"/>
                                <div @click="setSendNow()" class="ml-3">
                                    <label for="send_immediately" class="pt-1 block text-sm font-medium" :class="!sendLater ? 'text-gray-700':'text-gray-500'">
                                        Send now
                                    </label>
                                    <p class="text-xs mt-1" :class="sendLater ? 'text-gray-500':'text-gray-700'">The SMS rollout will begin immediately.</p>
                                </div>
                            </div>
                            <div class="border-t border-accent-900"></div>
                            <div class="flex items-center py-2 pl-4 rounded-b-md" :class="sendLater ? 'bg-accent-100':'bg-white'">
                                <input @input="setSendLater()" id="send_later" value="later" :checked="sendLater" name="sending_time" type="radio" class="h-4 w-4 text-accent-800 focus:ring-2 focus:ring-accent-800 border-gray-300">
                                <div @click="setSendLater()" class="ml-3">
                                    <label for="send_later" class="block mt-1 text-sm font-medium " :class="sendLater ? 'text-gray-700':'text-gray-500'">
                                        Schedule
                                    </label>
                                    <p class="text-xs mt-1" :class="sendLater ? 'text-gray-700':'text-gray-500'">Send at a preferred date and time.</p>
                                    <div class="h-8 flex py-1 bg-accent-100" v-if="sendLater">
                                        <div>
                                        <Datepicker v-bind:date="date"></Datepicker>
                                        </div>
                                        <div class="absolute h-8 right-20">
                                            <input type="time" :value="time" name="time" min="07:00" max="19:00" class="px-4 h-full text-xs border bg-accent-100 border-accent-900 rounded text-gray-500 font-semibold focus:border-gray-200 focus:ring-2 focus:ring-offset-0 focus:ring-accent-800"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </fieldset>
                </div>
                <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                    <div>
                        <a :href="sms.id ? '/scheduled/sms/edit/create': '/create'" class="inline-flex justify-center py-2 pl-2 pr-4 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary hover:bg-primary-500 focus:ring-primary-800">
                            <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            EDIT
                        </a>
                    </div>
                    <div> 
                        <button type="submit" class="inline-flex justify-center py-2 px-4 my-btn shadow-md border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                            <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            CONFIRM
                        </button>   
                    </div> 
                </div> 
            </form>           
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import Datepicker from './datepicker.vue';
export default {
    data(){ 
        return{
            senderName:'',
            messageText: '',
            listId: 0,
            date: undefined,
            time: '10:00',
            queued: false,
            sendLater: false,
            messagingList: ref(this.recipients[0]),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),            
        }
    },
    props:{
        recipients: Array,
        orderNo: String,
        sendAt: String,
        sms: Object,
    },
    methods:{
        setSendNow(){
            this.sendLater = false;
        },
        setSendLater(){
            this.sendLater = true;
        }
    },
    computed: {
        formAction(){
            return (this.sms.id) ? '/scheduled/sms/update' : '/create/confirm';
        }
    },
    mounted() {
        //console.log(this.sms);
        if(this.sms.status === "pending"){
            //this is an edit!
            this.sendLater = true; 
            if(this.sendAt != ''){
                const dt = new Date(this.sendAt);
                this.date = new Date(
                    dt.getFullYear(),
                    dt.getMonth()<10? "0"+dt.getMonth():dt.getMonth(),
                    dt.getDate()<10? "0"+dt.getDate():dt.getDate()
                );
                let hour = dt.getHours()<10? "0"+dt.getHours():dt.getHours();
                let mins = dt.getMinutes()<10? "0"+dt.getMinutes():dt.getMinutes();
                this.time = hour+":"+mins;
            }
        }
        if (this.sms.sender) {
          this.senderName = this.sms.sender;
          this.$refs.sender.value = this.sms.sender;
        }
        if(this.sms.message){
          this.messageText = this.sms.message;
          this.$refs.message.value = this.sms.message;
        }
        if(this.sms.recipient_list_id){
            this.$refs.recipientsListId.value = this.sms.recipient_list_id;
            for(var i=0; i< this.recipients.length; i++){
              if(this.recipients[i].id == this.sms.recipient_list_id){
                this.messagingList = ref(this.recipients[i]);
              }
            }
        }else{
            this.messagingList = ref(this.recipients[0]);
            this.$refs.recipientsListId.value = ref(this.recipients[0].id);
        }
      },
    components:{
        Datepicker,
    },
}
</script>
<style>
 .w-112{
    width: 28rem;
 }
</style>
