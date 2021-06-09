<template>
    <aside class="bg-primary-800 pt-16 hidden sm:block fixed h-full w-48"><!--44, 48, 52, 56-->
        <div class="grid gap-3">
            <a href="/admin/funds-reserve" v-bind:class="currentUrl == 'create' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'funds-reserve' ? 2:1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        FUNDS RESERVE
                    </p>
                </div>
            </a>
            <a href="/admin/tasks" v-bind:class="currentUrl == 'create' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'tasks' ? 2:1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        ROLLOUT TASKS
                    </p>
                </div>
            </a>
            <a href="/admin/spread-websockets" v-bind:class="currentUrl == 'create' ? 'bg-primary-400 text-white' : 'text-gray-100 hover:bg-primary-300 hover:text-accent-900'" class="my-sidebar-nav-link">
                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="currentUrl == 'tasks' ? 2:1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-headings tracking-wider font-bold">
                        WEB SOCKETS
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