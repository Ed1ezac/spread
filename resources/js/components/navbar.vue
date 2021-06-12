<template>
    <header class="fixed w-full z-50 shadow-md bg-primary-600 sm:flex sm:justify-between sm:px-4">
        <div class="flex items-center h-16 justify-between sm:justify-evenly px-4 py-8 sm:p-0">
            <!--Mobile View-->
            <!--/Logo-->
            <div>
                <a href="/">
                    <img class="h-9 hidden sm:inline-block" :src="logoUri" alt="logo">
                    <img class="h-9 sm:hidden" :src="logoUriSm" alt="logo">
                </a>
            </div>
            <!--button-->
            <div :class="isAuth ? 'order-first': 'order-last'" class="sm:hidden">
                <button @click="isOpen = !isOpen" type="button" class="block text-primary-200 hover:text-white focus:text-white focus:outline-none" 
                aria-controls="mobile-menu" aria-expanded="false">     
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path v-if="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    <path v-if="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                </button>
            </div>

            <!-- dp -->
            <div v-if="isAuth" class="sm:hidden ml-3 relative">
                <div class="flex items-center">
                    <div class="relative inline-block text-left">
                        <Menu>
                            <MenuButton type="button" class="bg-gray-800 relative z-50 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-primary-300" id="user-menu" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </MenuButton>
                            <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-out"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0"
                            >
                                <MenuItems class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none">
                                    <MenuItem>
                                        <h3 class="py-1 whitespace-normal px-4 text-sm w-40 text-gray-500">{{username}}</h3>
                                    </MenuItem>
                                    <MenuItem v-if="isAdmin" v-slot="{ active }">
                                        <a href="/admin/funds-reserve" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Admin Area</a>
                                    </MenuItem> 
                                    <MenuItem v-slot="{ active }">
                                        <a href="#" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 rounded-t-md text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Settings</a>
                                    </MenuItem> 
                                    <MenuItem v-slot="{ active }">
                                        <a v-on:click.prevent="logout" href="/logout" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 rounded-b-md text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Log Out</a>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>                
                </div>
                <!--logout form-->
                <form ref="mform" action="/logout" method="POST" class="hidden">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </div>
        </div>

        <!--mobile view menu -->
        <div :class="isOpen ? 'block': 'hidden'" class="sm:hidden overflow-auto pt-2 pb-4 sm:items-center px-2">
            <a v-if="!isAuth" :href="loginRoute" class="my-btn block px-2 py-1 hover:no-underline hover:bg-primary border-transparent focus:ring-transparent sm:border-white">LOG IN</a>
            <a v-if="!isAuth" :href="registerRoute" class="my-btn block px-2 py-1 sm:py-0 border-transparent hover:no-underline hover:bg-primary focus:ring-transparent sm:ml-2">REGISTER</a>
            <a v-if="isAuth" href="/create" class="mx-2 mt-2 p-2 bg-primary-400 flex items-center rounded-md hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold text-white">
                        NEW SMS *
                    </p>
                </div>
            </a>
            <a v-if="isAuth" href="/scheduled" class="mx-2 mt-1 p-2 flex items-center rounded-md text-gray-100 hover:bg-primary-300 hover:no-underline hover:text-accent-900">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        SCHEDULED
                    </p>
                </div>
            </a>
            <a v-if="isAuth" href="/recipients" class="mx-2 mt-1 p-2 flex items-center rounded-md hover:bg-primary-300 hover:no-underline text-gray-200 hover:text-accent-900">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold ">
                        RECIPIENTS
                    </p>
                </div>
            </a>
            <a v-if="isAuth" href="/statistics" class="mx-2 mt-1 p-2 flex items-center rounded-md text-gray-200 hover:bg-primary-300 hover:no-underline hover:text-accent-900">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        STATISTICS
                    </p>
                </div>
            </a>
            <a v-if="isAuth" href="/drafts" class="mx-2 mt-1 p-2 flex items-center rounded-md text-gray-200 hover:bg-primary-300 hover:no-underline hover:text-accent-900">
                <svg class="flex-shrink-0 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        DRAFTS
                    </p>
                </div>
            </a >
            <a v-if="isAuth" href="/funds" class="mx-2 mt-1 p-2 flex items-center rounded-md text-gray-200 hover:bg-primary-300 hover:no-underline hover:text-accent-900">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        FUNDS
                    </p>
                </div>
            </a >
        </div>

        <!--normal view menu-->
        <div class="sm:flex hidden sm:items-center pt-0 pb-0 px-2">
            <a v-if="!isAuth" :href="loginRoute" class="my-btn block px-2 py-1 hover:no-underline hover:bg-primary-400 border-transparent focus:ring-transparent sm:border-white">LOG IN</a>
            <a v-if="!isAuth" :href="registerRoute" class="my-btn block px-2 py-1 border-transparent hover:no-underline hover:bg-primary-400 focus:ring-transparent sm:ml-2">REGISTER</a>
        </div>
        <!--DP normal view-->
        <div v-if="isAuth" class="hidden sm:block self-center relative">
            <div class="flex items-center">
                <a href="/create" class="my-btn mr-3 flex px-2 py-1 items-center border-primary-400 focus:ring-offset-0 focus:ring-primary-300 hover:bg-primary-400 sm:ml-2 hover:no-underline">
                    <svg class="flex-shrink-0 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <div class="ml-2">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            CREATE SMS
                        </p>
                    </div>
                </a>
                <div class="relative inline-block text-left">
                    <Menu>
                        <MenuButton type="button" class="bg-gray-800 relative z-10 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-primary-300" id="user-menu" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </MenuButton>
                        <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-out"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                            <MenuItems class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none">
                                <MenuItem>
                                    <h3 class="py-1 whitespace-normal px-4 text-sm w-40 text-gray-500">{{username}}</h3>
                                </MenuItem>
                                <MenuItem v-if="isAdmin" v-slot="{ active }">
                                    <a href="/admin/funds-reserve" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Admin Area</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Settings</a>
                                </MenuItem> 
                                <MenuItem v-slot="{ active }">
                                    <a v-on:click.prevent="logout" href="/logout" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 rounded-b-md text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Log Out</a>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>                
            </div>
            <!--logout form-->
            <form ref="mform" action="/logout" method="POST" class="hidden">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
        
    </header>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
    export default {
        data () {
            return {
                isOpen: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        props:{
            isAdmin:{
                type: Boolean,
                default: false,
            },
            isAuth: Boolean,
            logoUri: String,
            logoUriSm:String,
            username: String,
            loginRoute: String,
            registerRoute: String,
        },
        methods:{
            logout: function(){
                this.$refs.mform.submit();
            },
        },
        components:{
            Menu, 
            MenuItem,
            MenuItems,
            MenuButton,
        }
    }
</script>