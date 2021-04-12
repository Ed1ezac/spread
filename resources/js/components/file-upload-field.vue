<template>
    <div :class="hasSelected ?'h-16':''" class="relative">
        <transition
            enter-active-class="transform-gpu duration-500 delay-75"
            enter-class="opacity-0 scale-0"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transform-gpu duration-700"
            leave-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-0"
        >
            <div v-show="!hasSelected" @dragover="dragover" @dragleave="dragleave" @drop="drop"
            class="mt-1 flex z-0 justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="data-file" class="relative cursor-pointer rounded-md font-medium text-accent-800 hover:text-accent-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-accent-500">
                            <span>Click to Upload a file</span>
                            <input id="data-file" name="data-file" type="file" multiple required ref="file" @change="onChange" class="sr-only"><!--  -->
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">csv, xls, xxls up to 10MB</p>
                </div>
            </div>
        </transition>
        <transition 
            enter-active-class="transform-gpu duration-700 ease-in-out"
            enter-class="opacity-0 translate-y-6"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transform-gpu duration-1000"
            leave-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-20">
            <div v-show="hasSelected" class="absolute top-0 p-2 bg-gray-600 hover:bg-gray-500 rounded-md w-full">
                <div class="flex justify-start items-center">
                    <button @click="remove(filelist.indexOf(file))" type="button" class="bg-gray-800 rounded-full border-2 border-white text-white hover:bg-white">
                        <svg class="h-7 w-7 hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="flex flex-col ml-3" v-for="file in filelist" :key="filelist.indexOf(file)">
                        <h3 class="text-sm text-white">{{ file.name }}</h3>
                        <p class="text-xs text-gray-200">{{ fileSize }}</p><!--  -->
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        //delimiters: ['${', '}'],
        data() {
            return {
                hasSelected: false,
                filelist:[],
            }
        },
        computed : {
            fileSize :{
                get : function(){
                    var size = this.filelist[0].size
                    return this.formatBytes(size)
                },
		    }
        },
        methods: {
            onChange() {
                this.filelist = [...this.$refs.file.files];
                this.hasSelected = true;
                //console.log('selection: '+ this.filelist);
            },

            remove(i) {
                this.filelist.splice(i, 1);
                this.hasSelected = false;
            },

            dragover(event) {
                event.preventDefault();
                //visual feedback
                if (!event.currentTarget.classList.contains('bg-gray-300')) {
                    event.currentTarget.classList.add('bg-gray-300');
                }
            },

            dragleave(event) {
                event.currentTarget.classList.remove('bg-gray-300');
            },
            drop(event) {
                event.preventDefault();
                this.$refs.file.files = event.dataTransfer.files;
                this.onChange();
                event.currentTarget.classList.remove('bg-gray-300');
            },
            formatBytes(a, b){
                if(0 == a)
                    return"0 Bytes";
                var c = 1024, 
                    d = b||2,
                    e = ["Bytes","KB","MB"],
                    f=Math.floor(Math.log(a)/Math.log(c));
                return parseFloat((a/Math.pow(c,f)).toFixed(d))+" "+e[f];
	        }
        }
    }
</script>    