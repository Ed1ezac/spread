<template>
    <div class="shadow-sm overflow-hidden rounded mr-6 w-96 mb-4 border-t-4 border-gray-500">
            <div class="bg-white px-4 pt-2 pb-3 space-y-4 sm:p-6">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-base font-bold ml-2 text-gray-600">{{ sms.sender }}</h3>
                </div>
                <div class="flex h-24">                 
                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <div class="bg-gray-200 ml-2 px-2 p-1 border-gray-400 border-2">
                        <p class="font-medium text-sm text-gray-800">{{ sms.message }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                <div>
                    <span class="sm:block">
                        <button @click="deleteItem()" class="inline-flex justify-center py-2 pl-2 pr-4 my-btn border-gray-300 text-gray-700 bg-gray-100 hover:border-primary hover:bg-primary-500 focus:ring-primary-800">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            DELETE
                        </button>
                    </span>
                    <form ref="deleteform" action="/drafts/item/delete" method="POST" class="hidden">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="id" :value="sms.id">
                    </form>
                </div>
                <div class="flex">
                    <span class="sm:block">
                        <button @click="gotoEdit" class="inline-flex justify-center py-2 px-4 my-btn shadow-md bg-primary-500 border-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            EDIT
                        </button>   
                    </span>
                </div>  
            </div>
        </div>
</template>

<script>
export default {
    data(){ 
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    props:{
        sms: Object,
    },
    methods:{
        deleteItem: function(){
            this.$refs.deleteform.submit();
        },
        gotoEdit: function(){
            localStorage.clear();
            //local storage override
            localStorage.sender = this.sms.sender;
            localStorage.message = this.sms.message;
            localStorage.messagingListId = undefined;
            window.location.href = "create"
        },
    }
}
</script>