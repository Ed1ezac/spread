<template>
  <div>
    <tabs :tabList="tabList">
      <template v-slot:tabPanel-1> Bank payment </template>
      <template v-slot:tabPanel-2> My Zaka payment</template>
      <template v-slot:tabPanel-3> Orange Money payment</template>
      <template v-slot:tabPanel-4> Smega Payment</template>
    </tabs>
  </div>
</template>

<script>
import Tabs from "./tabs";
export default {
    components: {
        Tabs,
    },
  
    data() {
        return {
            tabList: ["Bank", "Orange Money"],// "Smega","My Zaka", 
        };
    },
};
</script>