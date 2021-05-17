<template>
    <div :class="processed ? 'bg-white':'bg-gray-50'" class="shadow-md ml-4 mt-4 p-2 w-36 hover:shadow-lg border border-gray-300 overflow-hidden rounded-md">
        <div v-if="Recipients.status == 'processed' || Recipients.status == 'invalid'" class="relative flex justify-end -mb-2">
            <Menu>
                <MenuButton type="button" class="relative z-10 flex text-sm focus:outline-none focus:ring-0" id="options-menu" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">Open option menu</span>
                    <svg class="flex-shrink-0 h-4 w-4 text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </MenuButton>
                <transition
                    enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-out"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <MenuItems class="absolute right-0 w-28 mr-3 origin-top-right rounded-sm bg-primary-100 border border-primary-300 shadow-lg outline-none">
                        <MenuItem v-slot="{ active }">
                            <a :href="'/recipients/'+ Recipients.id +'/download'" :class="active ? 'bg-primary-200 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-xs font-bold font-headings tracking-wider text-gray-700 hover:bg-primary-200 hover:no-underline" role="menuitem">DOWNLOAD</a>
                        </MenuItem> 
                        <MenuItem v-slot="{ active }">
                            <a @click.prevent="deleteItem" href="/recipients/item/delete" :class="active ? 'bg-primary-200 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-xs font-bold font-headings tracking-wider text-gray-700 hover:bg-primary-200 hover:no-underline" role="menuitem">DELETE</a>
                        </MenuItem>
                    </MenuItems>
                </transition>
                <form ref="deleteform" action="/recipients/item/delete" method="POST" class="hidden">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="id" :value="Recipients.id">
                </form>
            </Menu>
        </div>
        <div class="flex justify-center flex-col">
            <svg class="flex-shrink-0 mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <div class=" flex flex-col justify-start items-center">
            <h3 class="mt-2 flex-sm-wrap">{{ Recipients.name }}</h3>
            <div v-if="Recipients.status == 'pending'" class="loader bg-accent-500 rounded-lg w-4 h-1 border-accent-500"></div>
            <p v-if="Recipients.status == 'processed'" class="mt-2 text-xs text-gray-400">{{Recipients.entries}} entries</p>
            <p v-if="Recipients.status == 'pending'" class="text-xs text-gray-400">processing...</p>
            <p v-if="Recipients.status == 'invalid'" class="mt-2 text-xs font-bold text-red-400">invalid entries!</p>
            </div>
        </div>
    </div> 
</template>

<script>
    import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
    export default {
        data(){ 
            return{
                processed: this.list.status == 'processed',
                Recipients: this.list,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')  
            }
        },
        props:{
            list: Object,
            userId: String,
        },
        methods:{
            deleteItem: function(){
                this.$refs.deleteform.submit();
            },
        },
        mounted () {
            if(this.Recipients.status == 'pending'){
                Echo.channel(`uploads.${this.userId}`)
                .listen('FileProcessingComplete', (e) => {
                    if(e.list.id == this.Recipients.id){
                        this.Recipients = e.list;
                        this.processed = true;
                    }
                }); 
            }  
        },
        components:{
            Menu, 
            MenuItem,
            MenuItems,
            MenuButton,
        }
    }
</script>
<style>
.loader{
	animation: loading 1s infinite;
}

@-webkit-keyframes loading{
    0%, 100% {
    -webkit-transform: translateX(-100%);
    animationTimingFunction: cubic-bezier(0.8, 0, 1, 1);
  }
  50% {
    -webkit-transform: translateX(100%);
    animationTimingFunction: cubic-bezier(0.8, 0, 1, 1);
  }
}

@keyframes loading {
  0%, 100% {
    transform: translateX(-100%);
    animationTimingFunction: cubic-bezier(0.8, 0, 1, 1);
  }
  50% {
    transform: translateX(100%);
    animationTimingFunction: cubic-bezier(0.8, 0, 1, 1);
  }
}
</style>