<template>
    <aside class="bg-primary-800 pt-16 hidden sm:block fixed h-full w-48 overflow-y-auto"><!--44, 48, 52, 56-->
        <div class="grid gap-3 mb-3">
            <a href="/admin/funds-reserve" v-bind:class="currentUrl == 'funds-reserve' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'funds-reserve' ? 2:1" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings uppercase tracking-wider font-bold">
                        Reserve
                    </p>
                </div>
            </a>
            <a href="/admin/users" v-bind:class="currentUrl == 'users' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'users' ? 2:1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings uppercase tracking-wider font-bold">
                        Users
                    </p>
                </div>
            </a>
            <a href="/admin/smses" v-bind:class="currentUrl == 'smses' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'smses' ? 2:1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings uppercase tracking-wider font-bold">
                        Smses
                    </p>
                </div>
            </a>
            <a href="/admin/files" v-bind:class="currentUrl == 'files' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'files' ? 2:1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings uppercase tracking-wider font-bold">
                        Files
                    </p>
                </div>
            </a>
            <a href="/admin/mailbox" v-bind:class="currentUrl == 'mailbox' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'smses' ? 2:1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings uppercase tracking-wider font-bold">
                        Mail
                    </p>
                </div>
            </a>
            <a href="/admin/queue" v-bind:class="currentUrl == 'queue' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'spread-websockets' ? 2:1" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
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
            <a href="/admin/rollout-tasks" v-bind:class="currentUrl == 'rollout-tasks' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'rollout-tasks' ? 2:1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
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
    </aside>    
</template>

<script>
export default {
    props:{
        currentUrl: String,
    },
}
</script>