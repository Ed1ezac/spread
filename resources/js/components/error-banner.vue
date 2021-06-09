<template>
  <transition
    leave-active-class="transform-gpu ease-out duration-300"
    leave-class="opacity-100"
    leave-to-class="opacity-0">
    <div v-if="isVisible" class="bg-red-600 mr-4 mb-4 max-h-14">
      <div class="max-w-7xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center">
            <span class="flex p-2 rounded-lg bg-red-800">
              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
            <p class="ml-3 font-medium text-white truncate">
              <span class="md:inline">
                {{ error }}
              </span>
            </p>
          </div>
          <!--div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
            <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
              Learn more
            </a>
          </!--div -->
          <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
            <button @click="isVisible = !isVisible" type="button" class="-mr-1 flex p-2 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
              <span class="sr-only">Dismiss</span>
              <!-- Heroicon name: outline/x -->
              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>  
</template>  


<script>
  export default {
    data () {
      return {
        isVisible: true,
        timerCount: 9,
      }
    },
    props:{
      error: String,
    },
    watch: {
      timerCount: {
        immediate: true,
        handler(value) {
          if (value > 0) {
            setTimeout(() => {
                this.timerCount--;
                if(this.timerCount == 0){
                  this.isVisible = false;
                }
            }, 1000);
          }
        },
      }
    }
  }
</script>