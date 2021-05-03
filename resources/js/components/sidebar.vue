<template>
    <aside class="bg-primary-800 pt-16 hidden sm:block fixed h-full w-48"><!--44, 48, 52, 56-->
        <div class="grid gap-3">
            <a href="/create" v-bind:class="currentUrl == 'create' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 mt-3 p-2 flex items-center rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'create' ? 2:1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        NEW SMS *
                    </p>
                </div>
            </a>
            <a href="/scheduled" v-bind:class="currentUrl == 'scheduled' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 p-2 flex items-center rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'scheduled' ?2:1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        SCHEDULED
                    </p>
                </div>
            </a>
            <a href="/recipients" v-bind:class="currentUrl == 'recipients' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 p-2 flex items-center rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'recipients' ? 2:1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold ">
                        RECIPIENTS
                    </p>
                </div>
            </a>
            <a href="/statistics" v-bind:class="currentUrl == 'statistics' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 p-2 flex items-center rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'statistics' ? 2:1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        STATISTICS
                    </p>
                </div>
            </a>
            <a href="/drafts" v-bind:class="currentUrl == 'drafts' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 p-2 flex items-center rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'drafts' ? 2:1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        DRAFTS
                    </p>
                </div>
            </a >
            <a href="/funds" v-bind:class="currentUrl == 'funds' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="mx-2 p-2 flex items-start rounded hover:no-underline">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'funds' ? 2:1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        FUNDS
                    </p>
                </div>
            </a >
        </div>
    </aside>
</template>

<script>
    export default {
        data () {
            return {
                lastUrl:'',
            }
        },
        props:{
            currentUrl: String,
        },
    }
</script>    