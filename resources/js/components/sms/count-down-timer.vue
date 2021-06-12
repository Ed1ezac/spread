<template>
    <div>
        <p v-if="!ready" class="text-gray-600 ml-2 self-center"><span class="font-bold">{{hour}}</span> hr <span class="font-bold">{{min}}</span> min <span class="font-bold">{{sec}}</span> sec</p>
        <p v-else class="text-gray-600 ml-2 self-center"><span class="font-bold">Sending...</span></p>
    </div>
</template>

<script>
export default {
  props : {
    end: { 
        type : String,
    },
    negative : { // optional, should countdown after 0 to negative
        type : Boolean,
        default : false
    }
  },
  data(){
    return{
        timer : null,
        ready: false,
        now : new Date(),
        endDate: Date.parse(this.end),
    }
  },
  computed:{
    day(){
        let d = Math.trunc((this.endDate - this.now)/1000/(86400));
        //console.log("Dif: "+(this.endDate - this.now)/1000/(3600*24));
    },
    hour(){
        let h = Math.trunc((this.endDate - this.now) / 1000 / 3600);
        return h>9?h:'0'+h;
    },
    min(){
        let m = Math.trunc((this.endDate - this.now) / 1000 / 60) % 60;
        return m>9?m:'0'+m;
    },
    sec(){
        let s = Math.trunc((this.endDate - this.now)/1000) % 60
        return s>9?s:'0'+s;
    }
  },
  watch : {
    endDate : {
        immediate : true,
        handler(newVal){
        if(this.timer){
            clearInterval(this.timer)
        }
        this.timer = setInterval(()=>{
            this.now = new Date()
            if(this.negative)
            return
            if(this.now > newVal){
              this.now = newVal
              this.ready = true
              this.$emit('time-up-event')
              clearInterval(this.timer)
            }
        }, 1000)
      }
    }
  },
  beforeUnmount(){
    clearInterval(this.timer)
  }
}
</script>