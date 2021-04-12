@extends('layouts.dashboard-header')

@section('features')
<!-- credit card details -->


@endsection
<!--
<template>
    <div>
        <div class="flex">
            <input v-show="toggle" type="text" ref="in" name="times" id="times"/>
            <h3 v-show="toggle" class="p-1 text-lg font-extrabold bg-green-200 text-green-600 rounded-md">YOU SEE ME x {{ num }}</h3>
            <h3 v-show="!toggle" class="p-1 text-lg font-extrabold bg-red-200 text-red-600 rounded-md">NOW YOU DONT!</h3>
        </div>
        <button type="button" @click="onChange" class="py-2 px-3 my-btn mt-2 bg-primary-500 hover:bg-primary-700">TOGGLE</button>
    </div>
</template>

<script>

    export default {
        //delimiters: ['${', '}'],
        components: {
            
        },
        data() {
            return {
               toggle:true,
               num: 0,
            } 
        },

        methods: {
            onChange() {
                this.num = this.$refs.in.values;
                this.toggle = !this.toggle;
            }
        }, 
    }
</script>    
-->