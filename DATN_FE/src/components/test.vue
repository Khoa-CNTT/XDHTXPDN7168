<template>
    <div>
      <button @click="showDynamicSuccess">Hiển thị Thành công</button>
      <button @click="showDynamicError">Hiển thị Lỗi</button>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        dynamicDescription: 'Chi tiết của thông báo cũng là động.', // Description động
      };
    },
    methods: {
      showDynamicSuccess() {
        this.$store.dispatch('showSuccess', {
          description: this.dynamicDescription,
        });
      },
      showDynamicError() {
        this.$store.dispatch('showError', {
          description: this.dynamicDescription,
        });
      },
    },
  };
  </script>
