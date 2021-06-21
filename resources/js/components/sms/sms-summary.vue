<template>
    <div>
        <div class="shadow-sm overflow-visible rounded-sm w-112 border-t-4 mb-2 mr-4 sm:mr-0 border-gray-500">
            <form :action="formAction" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <div class="relative bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
                <input type="hidden" ref="smsId" name="smsId">
                <!---Sender-->
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-base font-bold ml-2 self-center text-gray-600">{{ senderName }}</h3>
                    <input type="hidden" ref="sender" name="sender">
                </div>
                <!---Text--->
                <div class="flex">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <div class="ml-2 pl-2 p-1 bg-gray-200 border-gray-400 border-2">
                        <p class="font-medium text-gray-800 text-sm">{{ messageText }}</p>
                    </div>
                    <input type="hidden" ref="message" name="message">
                </div>
                <!---Recipients--->
                <div class="flex"> 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="leading-5 text-gray-600 self-center ml-2 text-base font-medium">{{ messagingList.name +' - '+messagingList.entries+' recipients' }}</p>
                    <input type="hidden" ref="recipientsListId" name="recipient-list-id">
                </div>
                <!--send options-->
                <fieldset>
                    <div class="mt-1">
                        <div class="flex items-center">
                        <input @input="toggle()" id="send_now" value="now" :checked="!sendLater" name="sending_time" type="radio" class="h-4 w-4 text-accent-800 focus:ring-2 focus:ring-accent-800 border-gray-300"/>
                        <label for="send_immediately" class="ml-3 pt-1 block text-sm font-medium text-gray-700">
                            Send now
                        </label>
                        </div>
                        <div class="flex items-center">
                            <input @input="toggle()" id="send_later" value="later" :checked="sendLater" name="sending_time" type="radio" class="h-4 w-4 text-accent-800 focus:ring-2 focus:ring-accent-800 border-gray-300">
                            <label for="send_later" class="ml-3 block mt-1 text-sm font-medium text-gray-700">
                                Start sending at:
                            </label>
                        </div>
                    </div>
                    <div class="h-8 flex mt-1 ml-2" v-if="sendLater">
                        <div>
                        <Datepicker 
                            v-bind:date="date"
                        ></Datepicker>
                        </div>
                        <div>
                            <input type="time" :value="time" name="time" min="07:00" max="22:00" class="px-4 h-full text-xs border border-gray-300 rounded text-gray-500 font-semibold focus:border-gray-200 focus:ring-2 focus:ring-offset-0 focus:ring-accent-800"/>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                <div>
                    <a href="/create" class="inline-flex justify-center py-2 pl-2 pr-4 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary hover:bg-primary-500 focus:ring-primary-800">
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
        <div v-if="sendLater" class="h-56"></div>
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
            time: undefined,
            queued: false,
            sendLater: false,
            messagingList: ref(this.recipients[0]),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),            
        }
    },
     props:{
        recipients: Array,
      },
    methods:{
        toggle(){
            this.sendLater = !this.sendLater;
        }
    },
    computed: {
        formAction(){
            return (localStorage.smsId) ? '/create/sms/update': '/create/confirm' ;
        }
    },
    mounted() {
        if(localStorage.smsId){
            //this is an edit!
            this.sendLater = true;
            this.$refs.smsId.value = localStorage.smsId;
            if(localStorage.sendingTime){
                this.time = localStorage.sendingTime; 
            }
            if(localStorage.sendingDate){
                let arr = localStorage.sendingDate.split("-");
                this.date = new Date(arr[0],arr[1], arr[2]);//year,month,day
            }
        }
        if (localStorage.sender) {
          this.senderName = localStorage.sender;
          this.$refs.sender.value = localStorage.sender;
        }
        if(localStorage.message){
          this.messageText = localStorage.message;
          this.$refs.message.value = localStorage.message;
        }
        if(localStorage.messagingListId){
            this.$refs.recipientsListId.value = localStorage.messagingListId;
            for(var i=0; i< this.recipients.length; i++){
              if(this.recipients[i].id == localStorage.messagingListId){
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
