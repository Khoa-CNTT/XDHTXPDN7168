<!-- YoutubeVideo.vue -->
<template>
    <div>
      <iframe
        width="1140px"
        height="654.075px"
        :src="embedUrl"
        frameborder="0"
        allowfullscreen
      ></iframe>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      videoId: {
        type: String,
        required: true
      }
    },
    computed: {
      embedUrl() {
        return `https://www.youtube.com/embed/${this.videoId}?modestbranding=1`;
      }
    }
  };
  </script>
  
  <style scoped>
    /* Style if needed */
  </style>
  