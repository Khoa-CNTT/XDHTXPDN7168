<template>
      <router-view></router-view>
      <Chatbot/>
</template>

<script>
import Chatbot from "./components/Chatbot/Chatbot.vue"
export default {
  components: {
    Chatbot
  },
};
</script>
<style>
</style>
