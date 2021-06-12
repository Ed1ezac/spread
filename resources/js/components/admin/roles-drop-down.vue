<template>
<div>
    <Listbox 
        as="div"
        v-model="role"
        v-slot="{ open }">
        <ListboxLabel class="my-form-label">Roles</ListboxLabel>
        <div class="relative">
            <ListboxButton class="cursor-default relative w-full py-2 px-3 font-body my-form-input border font-semibold">
            <span class="block truncate text-left">
                {{ role.name }}
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
                    v-for="roleItem in roles"
                    :key="roleItem.id"
                    :value="roleItem"
                    v-slot="{ selected, active }">
                    <div :class="active ? 'text-white bg-accent-600' : 'text-gray-800'" 
                        class="cursor-default select-none relative py-2 pl-8 pr-4'">
                        <span :class="selected ? 'font-semibold' : 'font-normal'" class="flex items-center truncate font-body">
                        {{ roleItem.name }}
                        </span>
                        <!--checkmark ico--->
                        <span v-if="selected" :class=" active ? 'text-white' : 'text-accent-600'" class="absolute inset-y-0 right-0 flex items-center pl-1.5`">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <!---roles icon--->
                        <span :class="`${
                                active ? 'text-white' : 'text-gray-800'
                            } absolute inset-y-0 left-0 flex items-center pl-1.5`">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" :stroke-width="selected ? '2':'1'" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </span>
                    </div>
                </ListboxOption>    
                </ListboxOptions>  
            </div>
            </transition>
        </div>
    </Listbox>
    <input type="hidden" :value="role.name" name="role"/>
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
export default {
    data(){ 
        return{
            role: ref(this.roles[0])
        }
    },
    props:{
        roles: Array,
    },
    components: {
        Listbox,
        ListboxLabel,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    }
}
</script>