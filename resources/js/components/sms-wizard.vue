<template>
    <div class="mt-2 mb-4 md:grid md:grid-cols-3 2xl:grid-cols-2 md:gap-4 xl:gap-0 px-4">
        <!--form-->
        <div class="shadow-sm col-span-2 2xl:col-span-1 pt-2 bg-white rounded-sm 2xl:max-w-full max-w-3xl md:mr-6">
            <form action="#" method="POST">
              <div class="px-6 py-2 space-y-6 sm:p-6">
                  <!--sender-->
                  <div>
                    <label for="sender_name" class="my-form-label">
                      Sender
                    </label>
                    <input type="text" v-model="titleText" name="sender_name" id="sender_name" autocomplete="sender-name" class="w-full my-form-input">
                  </div>
                  <!--message-->
                  <div>
                    <div class="flex justify-between items-center">
                      <label for="message" class="my-form-label">
                        Message
                      </label>
                      <span class="text-xs text-gray-500" v-text="(max - messageText.length)"></span>
                    </div>
                    <div class="mt-1">
                      <textarea id="message" v-model="messageText" name="message" rows="3" class="w-full my-form-input" placeholder="Type your text message here"></textarea>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">
                      140 symbols per message (including spaces).
                    </p>
                  </div>
                  <!--recipients-->
                  <div class="mb-2 focus:outline-none">
                    <label for="recipients" class="my-form-label">
                      Recipients
                    </label>
                    <select v-model="listItem" id="recipients" name="recipients" autocomplete="recipients" class="w-full py-2 px-3 font-body my-form-input border font-semibold">
                      <option v-for="recipient in recipients" :key="recipient.id" :value="recipient.name" class="font-semibold font-body text-gray-800">{{ recipient.name }}</option>
                      <!--option class="font-semibold font-body text-gray-800">Work Mates</!--option -->
                    </select>
                    <p class="mt-2 text-xs text-gray-500">
                      Dont have a recipient list yet? <a href="/recipients" class="text-accent-800 underline font-semibold hover:text-accent-500">create one</a>
                    </p>
                  </div>
              </div>
            </form>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" @click="persist" class="inline-flex justify-center py-2 px-4 shadow-md my-btn border-primary-500 bg-primary-500 hover:bg-primary-700 focus:ring-primary-800">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                PROCEED
              </button>   
            </div>
        </div>
        <!--preview-->
        <div class="px-2 hidden md:block w-60 relative">
            <div class="absolute mt-16 ml-4 w-40 ">
            <p id="title" class="text-sm bg-red-300 truncate font-sans mx-3 text-gray-100">{{ titleText }}</p>
            </div>
            <div v-if="messageText != ''" class="absolute bg-gray-300 mt-28 rounded-r-lg rounded-tl-lg py-1 ml-4 w-7/12">
            <p id="text" class="text-xs font-sans ml-2 text-gray-700">{{ messageText }}</p>
            </div>
            <img class="max-h-96" :src="graphicUri" alt="preview"> 
        </div>
    </div>
</template>

<script>
    export default {
      data(){ 
          return{
              max: 140,
              titleText:'',
              listItem: null,
              messageText: '',
          }
      },
      props:{
          graphicUri: String,
          recipients: Object,
      },
      methods:{
          updateTitle(){
              this.titleText = this.$refs.sender.value;
          },
          persist() {
            localStorage.sender = this.titleText;
            localStorage.message = this.messageText;
          },
      },
      mounted() {
        if (localStorage.sender) {
          this.titleText = localStorage.sender;
        }
        if(localStorage.message){
          this.messageText = localStorage.message;
        }
      },
    }
</script>
