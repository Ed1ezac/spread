<template>
<!----------- ---------->
    <div class="shadow-sm overflow-hidden divide-y divide-dashed divide-gray-300 rounded mb-10 mr-4 xl:mr-6 max-w-7xl border-t-4 border-accent-600">
        <div class="mb-2 px-4">
            <div class="flex justify-between my-2">
                <h3 class="text-sm text-gray-400">{{ statusValue }}</h3>
                <div class="flex mr-1">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-gray-500 ml-2 text-sm font-bold">{{recipientsName}}</h3>
                </div>
            </div>
            <div class="h-5 w-full shadow-inner bg-gray-200 rounded-full">
                <div v-if="percentage>0" 
                    class="h-full px-1 rounded-full" 
                    :class="isSending ? 'bg-accent-600': aborted ? 'bg-red-600': 'bg-primary-600'"
                    :style="barStyle">
                    <div class="text-right">
                        <h3 v-if="percentage > 4" class="text-white font-bold">{{ percentage }}%</h3>
                    </div>
                </div>
                <div v-else class="animate-pulse bg-gray-300 h-full w-full rounded-full"></div>
            </div>
            <div class="flex mt-1 font-bold px-1 justify-between">
                <div class="flex">
                    <h3 class="text-gray-700 text-xs">{{current}}</h3>
                    <h3 class="text-gray-700 ml-4 text-xs">{{sendingRate + ' sms/sec'}}</h3>
                </div>
                <h3 class="text-gray-700 text-xs">{{total}}</h3>
            </div>
        </div>
        <div class="bg-gray-100 mt-2 px-4 pt-2 pb-3 space-y-2">
            <div class="flex items-center">
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <div v-if="false" class="animate-pulse bg-gray-300 ml-4 rounded h-4 w-16"></div>
                <h3 v-else class="text-sm font-bold ml-4 pt-1 text-gray-600">{{sms.sender}}</h3>
            </div>
            <div class="flex h-20 md:h-14">                
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <div class="bg-gray-200 ml-4 px-2 p-1 w-full border-gray-400 border-2">                    
                    <p class="font-medium text-sm text-gray-600">{{sms.message}}</p>
                </div>
            </div>
            <div class="flex">
                <!--p v-else v-if="recipients != null" class="text-gray-500 ml-2 pt-1 text-base font-medium">{{ recipients.name }}</!--p -->
                <p v-if="false" class="bg-red-100 rounded text-red-400 ml-2 p-1 pt-1 text-base font-medium">missing recipients, sending will fail!</p>
            </div>
            <div v-if="canAbort" class="flex justify-end">
                <span class="sm:block">
                    <button @click="abortRollout()" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        ABORT
                    </button> 
                </span>
                <form ref="abortform" action="/sms/rollout/abort" method="POST" class="hidden">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="id" :value="sms.id">
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){ 
        return{
            total: undefined,
            current: undefined,
            sendingRate: 0,
            aborted: false,
            discovered: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    props:{
        recipientsName: {
            type: String,
            default: '',
        },
        sms: Object,
        userId: String,
    },
    computed: {
        percentage(){
            return this.current == undefined? 0: Math.round((this.current/this.total)*100).toFixed(0);
        },
        barStyle () {
            let style = {}
            style.width = this.percentage + '%'
            return style
        },
        statusValue(){   
            if((this.isSending) && (!this.isCompleted)){
                return 'Sending...';
            }else if(this.isCompleted){
                return 'Complete.';
            }else if(this.aborted){
                return 'Stopped.'
            }else{
                return 'Queued...';
            }
        },
        isSending(){
            return this.isDiscovered && this.percentage < 100 && !this.aborted;
        },
        canAbort(){
            return !this.aborted && this.isDiscovered && this.percentage <= 80;
        },
        isCompleted(){
            return this.percentage >= 100;
        },
        isDiscovered(){
            return this.discovered;
        }
    },
    methods :{
        abortRollout: function(){
            if(this.sms.id != undefined){
                this.aborted = true;
                this.$refs.abortform.submit();
            }
        },
    },
    mounted () {
        if(this.percentage < 100){
            Echo.private(`rollouts.${this.userId}`)
            .listen('ReportProgress', (e) => {
                if(this.sms.id === e.smsId){
                    if(this.discovered){   
                        this.current = e.current;
                        this.sendingRate = e.sendingRate;
                    }else{
                        this.discovered = true;
                        this.total = e.total;
                        this.current = e.current;
                        this.sendingRate = e.sendingRate;
                        this.recipientsName = e.smsRecipients;
                    }
                }
            })
            .listen('RolloutComplete', (e) =>{
                
            });
        } 
    },
}
</script>