<template>
    <div class="chatbox">
      <div class="messages">
        <div v-for="(msg, index) in messages" :key="index" :class="msg.role">
          <p>{{ msg.content }}</p>
        </div>
      </div>
      <input
        v-model="userMessage"
        @keyup.enter="sendMessage"
        placeholder="Nhập tin nhắn..."
      />
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        userMessage: '',
        messages: [], // Danh sách tin nhắn
      };
    },
    methods: {
      async sendMessage() {
        if (!this.userMessage.trim()) return;

        // Thêm tin nhắn của người dùng vào danh sách
        this.messages.push({ role: 'user', content: this.userMessage });

        // Gửi yêu cầu đến server
        try {
          const response = await axios.post(import.meta.env.VITE_API_URL + 'chat', {
            message: this.userMessage,
          });
          this.messages.push({ role: 'bot', content: response.data.message });
        } catch (error) {
          this.messages.push({ role: 'bot', content: 'Có lỗi xảy ra, vui lòng thử lại.' });
        } finally {
          this.userMessage = '';
        }
      },
    },
  };
  </script>

  <style>
  .chatbox {
    width: 100%;
    max-width: 600px;
    margin: auto;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
  }
  .messages {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 10px;
  }
  .user {
    text-align: right;
    color: blue;
  }
  .bot {
    text-align: left;
    color: green;
  }
  </style>
