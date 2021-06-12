<template>
    <div class="relative">
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
                <MenuItems class="absolute right-0 w-28 mr-3 origin-bottom-right rounded-sm bg-primary-100 border border-primary-300 shadow-lg outline-none">
                    <MenuItem v-slot="{ active }">
                        <a href="#" :class="active ? 'bg-primary-200 text-gray-900':'text-gray-700'" class="my-popup-menu-link" role="menuitem">Suspend</a>
                    </MenuItem> 
                    <MenuItem v-slot="{ active }">
                        <a :href="'/admin/users/user/'+userId+'/edit/funds'" :class="active ? 'bg-primary-200 text-gray-900':'text-gray-700'" class="my-popup-menu-link" role="menuitem">Edit funds</a>
                    </MenuItem> 
                    <MenuItem v-slot="{ active }">
                        <a :href="'/admin/users/user/'+userId+'/edit/roles'" :class="active ? 'bg-primary-200 text-gray-900':'text-gray-700'" class="my-popup-menu-link" role="menuitem">Edit Roles</a>
                    </MenuItem>
                </MenuItems>
            </transition>
            <form ref="deleteform" action="/user/suspend" method="POST" class="hidden">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="id" :value="userId">
            </form>
        </Menu>
    </div>
</template>
<script>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
export default {
    data(){ 
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')  
        }
    },
    mounted(){
        console.log(this.userId)
    },
    props:{
        userId: String,
    }, 
    components:{
        Menu, 
        MenuItem,
        MenuItems,
        MenuButton,
    }
}
</script>