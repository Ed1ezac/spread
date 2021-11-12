<template>
    <div class="flex mt-2 mb-4 flex-wrap px-4">
        <!--form-->
        <div class="shadow-sm flex-shrink bg-white rounded-md w-120 md:mr-2">
          <div class="flex justify-end relative mr-4 mt-2 -mb-4">
            <span class="sr-only">Erase</span>
            <button @click="erase" class="rounded text-gray-600 hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
          <form ref="smsform" action="/create/verify" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <div class="px-6 pb-2 space-y-6 sm:p-6">
                <!--sender-->
                <SenderNamePicker
                  v-on:sender-name-change="onUpdateTittle"
                  v-bind:sender-error="senderError"
                  v-bind:sender-names="senderNames">           
                </SenderNamePicker>
                <!--message-->
                <div>
                  <div class="flex justify-between items-center">
                    <label for="message" class="my-form-label">
                      Message
                    </label>
                    <span class="text-xs text-gray-500" v-text="(max - messageText.length)"></span>
                  </div>
                  <div class="mt-1">
                    <textarea id="message" v-model="messageText" name="message" maxlength="160" rows="3" class="w-full my-form-input" placeholder="Type your text message here" required></textarea>
                    <span v-if="messageError!=''" class="text-xs p-1 bg-red-100 rounded font-normal text-red-400" role="alert">
                      <strong>{{ messageError }}</strong>
                    </span>
                  </div>
                  <p class="mt-2 text-xs text-gray-500">
                    160 symbols per message (including spaces).
                  </p>
                </div>
                <!--recipients-->
                <div class="mb-2 focus:outline-none">
                  <div class="w-full">
                    <Listbox 
                      as="div"
                      v-model="messagingListItem"
                      v-slot="{ open }">
                      <ListboxLabel class="my-form-label">Recipients</ListboxLabel>
                      <div class="relative">
                        <ListboxButton class="cursor-default relative w-full py-2 px-3 font-body my-form-input border font-semibold">
                          <span class="block truncate text-left">
                            {{ messagingListItem.name }}
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
                                v-for="listItem in recipients"
                                :key="listItem.id"
                                :value="listItem"
                                v-slot="{ selected, active }">
                                <div :class="active ? 'text-white bg-accent-600' : 'text-gray-800'" 
                                  class="cursor-default select-none relative py-2 pl-8 pr-4'">
                                  <span :class="selected ? 'font-semibold' : 'font-normal'" class="flex items-center truncate font-body">
                                  {{ listItem.name }}
                                  </span>
                                  <!--checkmark ico--->
                                  <span v-if="selected" :class=" active ? 'text-white' : 'text-accent-600'" class="absolute inset-y-0 right-0 mr-2 flex items-center pl-1.5`">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                      fill="currentColor">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"/>
                                    </svg>
                                  </span>
                                  <!---recipients icon--->
                                  <span :class="`${
                                    active ? 'text-white' : 'text-gray-800'
                                  } absolute inset-y-0 left-0 flex items-center pl-1.5`">
                                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="selected ? '2':'1'" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                  </span>
                                </div>
                              </ListboxOption>    
                            </ListboxOptions>  
                          </div>
                        </transition>
                      </div>
                    </Listbox>
                  </div>
                  <input type="hidden" ref="listInput" :value="messagingListItem.id" name="recipient-list-id"/>
                  <p class="mt-2 text-xs text-gray-500">
                    Do you need a different recipient list? <a href="/recipients" class="text-accent-800 underline font-semibold hover:text-accent-500">create one</a>
                  </p>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" formaction="/create/save-as-draft" class="inline-flex justify-center py-2 px-4 mr-2 my-btn border-gray-300 text-gray-700 bg-gray-50 hover:border-primary-500 hover:bg-primary-500 focus:ring-primary-800">
                  <svg class="mr-1 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                  </svg>
                  SAVE DRAFT
              </button>
              <button type="submit" @click.prevent="submitForm" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                PROCEED
              </button>  
            </div>
          </form>  
        </div>
        <!--preview-->
        <div class="px-2 ml-8 2xl:ml-12 hidden md:block w-60 relative">
            <div class="absolute mt-16 ml-7 w-36">
            <p id="title" class="text-sm truncate font-sans mx-3 text-white cursor-default">{{ titleText }}</p>
            </div>
            <div v-if="messageText != ''" class="absolute bg-gray-300 mt-28 rounded-r-lg rounded-tl-lg py-1 ml-5 w-7/12">
            <p id="text" class="text-xs font-sans ml-2 text-gray-700 cursor-default">{{ messageText }}</p>
            </div>
            <img class="max-h-96" :src="graphicUri" alt="preview">
        </div>
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
  import SenderNamePicker from './sender-name-picker.vue'
    export default {
      data(){ 
          return{
              max: 160,
              titleText:'',
              listId: 0,
              messageText: '',
              messagingListItem: ref(this.recipients[0]),
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
      },
      props:{
          senderError:String,
          messageError:String,
          graphicUri: String,
          recipients: Array,
          senderNames: Array,
      },
      methods:{
        onUpdateTittle: function(newTitle){
          this.titleText = newTitle;
        },
        erase(){
          localStorage.clear();
          this.titleText = '';
          this.messageText = '';
        },
        persistData() {
          localStorage.sender = this.titleText;
          localStorage.message = this.messageText;
          localStorage.messagingListId = this.messagingListItem.id;
        },
        submitForm(){
          this.persistData();
          //append value to: name:messaging-list-id
          //this.$refs.listInput.value = this.messagingListItem.id;
          this.$refs.smsform.submit();
        },
      },
      mounted() {
        //sessionStorage.test = "hello session";works!
        if (localStorage.sender) {
          this.titleText = localStorage.sender;
        }
        if(localStorage.message){
          this.messageText = localStorage.message;
        }
        if(localStorage.messagingListId){
            for(var i=0; i< this.recipients.length; i++){
              if(this.recipients[i].id == localStorage.messagingListId){
                this.messagingListItem = ref(this.recipients[i]);
              }
            }
        }else{
            this.messagingListItem = ref(this.recipients[0]);
        }
      },
      components: {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
        SenderNamePicker
      }
    }
</script>
<style>
 .w-120{
    width: 30rem;
 }
</style>
