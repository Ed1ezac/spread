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
                                <div class="w-8 h-8 bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                    <span class="table-cell text-sm text-white font-bold align-middle">{{ initials }}</span>
                                </div>
                            </MenuButton>
                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-out"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                                >
                                <MenuItems class="absolute right-0 w-52 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none">
                                    <MenuItem>
                                        <div class="flex-col border-b bg-gray-50 border-gray-100">
                                            <h3 class="pt-1 whitespace-normal px-4 text-sm w-52 text-gray-400">{{username}}</h3>
                                            <h3 class="whitespace-normal px-4 text-sm w-52 text-gray-400">{{institution}}</h3>
                                            <p class="whitespace-normal px-4 text-sm font-semibold w-48 text-accent-800">{{funds}}<span class="text-xs font-normal text-gray-400"> sms left</span></p>
                                        </div>
                                    </MenuItem>
                                    <MenuItem v-if="isAdmin" v-slot="{ active }">
                                        <a href="/admin/funds-reserve" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Admin Area</a>
                                    </MenuItem> 
                                    <MenuItem v-slot="{ active }">
                                        <a href="/settings" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 rounded-t-md text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Settings</a>
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
            <div v-if="isAuth && !isOnAdmin">
                <a href="/create" v-bind:class="currentUrl == 'create' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-2 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'create' ? 2:1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            NEW SMS *
                        </p>
                    </div>
                </a>
                <a href="/scheduled" v-bind:class="currentUrl == 'scheduled' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-1 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'scheduled' ?2:1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            SCHEDULED
                        </p>
                    </div>
                </a>
                <a href="/recipients" v-bind:class="currentUrl == 'recipients' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-1 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'recipients' ? 2:1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold ">
                            RECIPIENTS
                        </p>
                    </div>
                </a>
                <a href="/statistics" v-bind:class="currentUrl == 'statistics' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-1 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'statistics' ? 2:1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            STATISTICS
                        </p>
                    </div>
                </a>
                <a href="/drafts" v-bind:class="currentUrl == 'drafts' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-1 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'drafts' ? 2:1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            DRAFTS
                        </p>
                    </div>
                </a >
                <a href="/funds" v-bind:class="currentUrl == 'funds' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mt-1 rounded-md my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'funds' ? 2:1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings tracking-wider font-bold">
                            FUNDS
                        </p>
                    </div>
                </a>
            </div>
            <div v-if="isAuth && isAdmin && isOnAdmin">
                <a href="/admin/funds-reserve" v-bind:class="currentAdminUrl == 'funds-reserve' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'funds-reserve' ? 2:1" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Reserve
                        </p>
                    </div>
                </a>
                <a href="/admin/users" v-bind:class="currentAdminUrl == 'users' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'users' ? 2:1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Users
                        </p>
                    </div>
                </a>
                <a href="/admin/smses" v-bind:class="currentAdminUrl == 'smses' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'smses' ? 2:1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Smses
                        </p>
                    </div>
                </a>
                <a href="/admin/files" v-bind:class="currentAdminUrl == 'files' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'files' ? 2:1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Files
                        </p>
                    </div>
                </a>
                 <a href="/admin/mailbox" v-bind:class="currentAdminUrl == 'mailbox' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'smses' ? 2:1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Mail
                        </p>
                    </div>
                </a>
                <a href="/admin/queue" v-bind:class="currentAdminUrl == 'queue' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'spread-websockets' ? 2:1" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Queue
                        </p>
                    </div>
                </a>
                <a href="/admin/sender-names" v-bind:class="currentUrl == 'sender-names' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'sender-names' ? 2:1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Senders
                        </p>
                    </div>
                </a>
                <a href="/admin/rollout-tasks" v-bind:class="currentAdminUrl == 'rollout-tasks' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentAdminUrl == 'rollout-tasks' ? 2:1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Rollouts
                        </p>
                    </div>
                </a>
                <a href="/admin/orange-info" v-bind:class="currentUrl == 'orange-info' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'orange-info' ? 2:1" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-headings uppercase tracking-wider font-bold">
                            Orange Info
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <!--normal view menu-->
        <div class="sm:flex hidden sm:items-center pt-0 pb-0 px-2">
            <a v-if="!isAuth" :href="loginRoute" class="my-btn block px-2 py-1 hover:no-underline hover:bg-primary-400 border-transparent focus:ring-offset-0 focus:ring-primary-300 sm:border-primary-400">LOG IN</a>
            <a v-if="!isAuth" :href="registerRoute" class="my-btn block px-2 py-1 border-transparent hover:no-underline hover:bg-primary-400 focus:ring-offset-0 focus:ring-primary-300 sm:ml-2">REGISTER</a>
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
                            <div class="w-8 h-8 bg-gray-700 rounded-full overflow-hidden shadow-inner text-center bg-purple table">
                                <span class="table-cell text-sm text-white font-bold align-middle">{{ initials }}</span>
                            </div>
                        </MenuButton>
                        <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-out"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems class="absolute right-0 w-52 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none">
                                <MenuItem>
                                     <div class="flex-col border-b bg-gray-50 border-gray-100">
                                        <h3 class="pt-1 whitespace-normal px-4 text-sm w-52 text-gray-400">{{username}}</h3>
                                        <h3 class="whitespace-normal px-4 text-sm w-52 text-gray-400">{{institution}}</h3>
                                        <p class="whitespace-normal px-4 text-sm font-semibold w-48 text-accent-800">{{funds}}<span class="text-xs font-normal text-gray-400"> sms left</span></p>
                                    </div>
                                </MenuItem>
                                <MenuItem v-if="isAdmin" v-slot="{ active }">
                                    <a href="/admin/funds-reserve" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Admin Area</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a href="/settings" :class="active ? 'bg-gray-100 text-gray-900':'text-gray-700'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:no-underline" role="menuitem">Settings</a>
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
            currentAdminUrl: {
                type: String,
                default: '',
            },
            funds: Number,
            isAuth: Boolean,
            logoUri: String,
            logoUriSm:String,
            username: String,
            institution: String,
            initials: String,
            currentUrl: String,
            loginRoute: String,
            registerRoute: String,
        },
        computed: {
            isOnAdmin(){
                return this.currentUrl === 'admin';
            }
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