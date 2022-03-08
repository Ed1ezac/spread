<template>
    <div :class="{flex: variant === 'horizontal',}">
        <ul class="list-none gap-8 text-center overflow-auto whitespace-nowrap"
            :class="{flex: variant === 'vertical',}">
            <li v-for="(tab, index) in tabList" 
                :key="index"
                :class="{'text-gray-800 text-sm bg-gray-200 font-medium rounded px-2': index + 1 === activeTab,
                'text-gray-400 text-sm': index + 1 !== activeTab,}">
                <label :for="`${_uid}${index}`" 
                    v-text="tab" class="cursor-pointer block"/>
                <input
                    :id="`${_uid}${index}`"
                    type="radio"
                    :name="`${_uid}-tab`"
                    :value="index + 1"
                    v-model="activeTab"
                    class="hidden"/>
            </li>
        </ul>

        <template v-for="(tab, index) in tabList">
            <div 
                :key="index" v-if="index + 1 === activeTab"
                class="flex-grow bg-white shadow-md mt-3 rounded p-4">
                <slot :name="`tabPanel-${index + 1}`" />
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        tabList: {
            type: Array,
            required: true,
        },
        variant: {
            type: String,
            required: false,
            default: () => "vertical",
            validator: (value) => ["horizontal", "vertical"].includes(value),
        },
    },

    data() {
        return {
        activeTab: 1,
        };
    },
};
</script>

<style>
.flex {
    display: flex;
}
</style>