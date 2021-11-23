<template>
    <div>
        <Listbox 
            as="div"
            v-model="senderName"
            v-slot="{ open }">
            <ListboxLabel class="my-form-label">Sender Name</ListboxLabel>
            <div class="relative">
                <ListboxButton class="cursor-default relative w-full py-2 px-3 font-body my-form-input border font-semibold">
                    <span class="block truncate text-left">
                    {{ senderName }}
                    </span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
                    </svg>
                    </span>
                </ListboxButton>
                <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                    <div v-if="open" class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
                        <ListboxOptions static class="max-h-60 rounded-md py-1 text-base leading-6 
                            shadow-sm border border-gray-200 overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                            <ListboxOption
                                v-for="listItem in senderNames"
                                :key="listItem.id"
                                :value="listItem"
                                v-slot="{ selected, active }">
                                <div :class="active ? 'text-white bg-accent-600' : 'text-gray-800'" 
                                    class="cursor-default select-none relative py-2 pl-8 pr-4'">
                                    <span :class="selected ? 'font-semibold' : 'font-normal'" class="flex items-center truncate font-body">
                                        {{ listItem }}
                                    </span>
                                    <!--checkmark icon--->
                                    <span v-if="selected" :class=" active ? 'text-white' : 'text-accent-600'" class="absolute inset-y-0 right-0 mr-2 flex items-center pl-1.5`">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    <!---sender icon--->
                                    <span :class="`${
                                        active ? 'text-white' : 'text-gray-800'
                                    } absolute inset-y-0 left-0 flex items-center pl-1.5`">
                                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="selected ? '2':'1'" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                </div>
                            </ListboxOption>
                        </ListboxOptions>
                    </div>
                </transition>
            </div>
        </Listbox>
       
        <input type="hidden" name="sender" :value="senderName" autocomplete="sender">
        <span v-if="senderError!=''" class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
            <strong>{{ senderError }}</strong>
        </span>
        <p v-else class="mt-2 text-xs text-gray-500">
            Do you need a different sender name? <a href="/settings/register/new/sender-name" class="text-accent-800 underline font-semibold hover:text-accent-500">create one</a>
        </p>
    </div>
</template>
    
<script>
    import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    } from '@headlessui/vue'
    import { ref } from 'vue'
export default {
    name: 'SenderNamePicker',
    data(){ 
        return{
            senderName: ref(this.senderNames[0]),
        }
    },
    mounted() {
        if (localStorage.sender) {
            for(var i=0; i< this.senderNames.length; i++){
                if(this.senderNames[i] == localStorage.sender){
                    this.senderName = ref(this.senderNames[i]);
                    this.emitSenderNameChange( this.senderName);
                }
                if(i == this.senderNames.length-1 && this.senderName != localStorage.sender){
                    this.senderName = ref(this.senderNames[0]);
                    this.emitSenderNameChange( this.senderName);
                }
            }
        }else{
           this.senderName = ref(this.senderNames[0]);
           this.emitSenderNameChange( this.senderName);
        }
    },
    props:{
        senderError: String,
        senderNames: Array,
        hasCleared: Boolean
    },
    watch:{
        senderName:{ 
            handler: function(newVal, oldVal){
                if(newVal != oldVal){
                    this.emitSenderNameChange(newVal);
                }
            }
        },
        hasCleared:{
            handler: function(newVal, oldVal){
                if(newVal && !oldVal){ 
                    this.clearCurrentSenderNameSelection(newVal);
                }
            }
        },
    },
    methods:{
        emitSenderNameChange(newName){
            this.$emit('sender-name-change', newName);
            localStorage.sender = this.senderName;
        },
        clearCurrentSenderNameSelection(doClear){
            if(doClear){
                this.senderName = ref(this.senderNames[0]);
                this.emitSenderNameChange(this.senderName);
                this.$emit('sender-name-reset');
            }
        }
    },
    components: {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    }
}
</script>