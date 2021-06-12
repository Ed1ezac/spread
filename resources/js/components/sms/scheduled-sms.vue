<template>
    <div class="shadow-sm overflow-hidden rounded mb-4 mr-4 w-112 border-t-4 border-gray-500">
        <div class="bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
            <div class="flex items-center">
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h3 class="text-base font-bold ml-2 text-gray-600">{{sms.sender}}</h3>
            </div>
            <div class="flex h-20">                 
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <div class="bg-gray-200 ml-2 px-2 p-1 w-full border-gray-400 border-2">
                    <p class="font-medium text-sm text-gray-800">{{ sms.message }}</p>
                </div>
            </div>
            <div class="flex"> 
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p v-if="recipients != null" class="text-gray-500 ml-2 pt-1 text-base font-medium">{{ recipients.name }}</p>
                <p v-else class="bg-red-100 rounded text-red-400 ml-2 p-1 pt-1 text-base font-medium">missing recipients, sending will fail and sms will be deleted!</p>
            </div>
            <div class="flex">
                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <count-down-timer 
                    @time-up-event="changeStatusToSending"
                    v-bind:end="sms.send_at"
                ></count-down-timer>
            </div>
        </div>
        <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
            <div>
                <span class="sm:block">
                    <button @click="abortRollout()" class="inline-flex justify-center py-2 px-4 my-btn border-transparent text-gray-700 bg-gray-50 hover:border-primary hover:bg-primary-500 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        ABORT
                    </button> 
                </span>
                <form ref="abortform" action="/scheduled/sms/abort" method="POST" class="hidden">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="id" :value="sms.id">
                </form>
            </div>
            <div v-if="isPending" class="flex">
                <span class="sm:block">
                    <button @click="beginRollout()" type="button" class="inline-flex justify-center py-2 px-4 mr-2 my-btn border-gray-300 text-gray-700 bg-gray-100 hover:border-primary hover:bg-primary-500 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 transform rotate-45 flex-shrink h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        SEND NOW 
                    </button>
                    <form ref="beginform" action="/scheduled/sms/send-now" method="POST" class="hidden">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="id" :value="sms.id">
                    </form>
                </span>
                <span class="sm:block">
                    <button @click="gotoSummary()" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="flex-shrink-0 -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        EDIT
                    </button>   
                </span>
            </div>  
            <div v-else>
                <span class="sm:block">
                    <button @click="gotoStatistics()" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        VIEW PROGRESS
                    </button> 
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import CountDownTimer from './count-down-timer.vue';
export default {
    data(){
        return{
            isPending: true,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods:{
        changeStatusToSending(){
            this.isPending = false;
            if(this.recipients === null){
                this.abortRollout();
            }
        },
        abortRollout: function(){
            this.$refs.abortform.submit();
        },
        beginRollout: function(){
            this.$refs.beginform.submit();
        },
        gotoSummary: function(){
            const dt = new Date(this.sms.send_at);
            //'YYYY.MM.DD'
            let date = dt.getDate()<10? "0"+dt.getDate():dt.getDate();
            let month = dt.getMonth()<10? "0"+dt.getMonth():dt.getMonth();
            let hour = dt.getHours()<10? "0"+dt.getHours():dt.getHours();
            let mins = dt.getMinutes()<10? "0"+dt.getMinutes():dt.getMinutes();
            const day = dt.getFullYear()+"-"+month+"-"+date;
            const time = hour+":"+mins;
            //local storage override
            localStorage.smsId = this.sms.id;
            localStorage.sender = this.sms.sender;
            localStorage.message = this.sms.message;
            localStorage.messagingListId = this.sms.recipient_list_id;
            localStorage.sendingDate = day;
            localStorage.sendingTime = time;
            window.location.href = "create/summary/"+this.sms.recipient_list_id;
        },
        gotoStatistics: function(){
            window.location.href = "/statistics"
        }
    },
    props:{
        sms: Object,
        recipients: Object,
    },
    
    components:{
        CountDownTimer,
    }
}
</script>
<style>
 .w-112{
    width: 28rem;
 }
</style>