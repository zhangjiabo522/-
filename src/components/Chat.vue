
<template>
  <div class="chat-container">
    <h2>聊天室</h2>
    <div class="messages">
      <div v-for="(message, index) in messages" :key="index" class="message">
        <strong>{{ message.username }}:</strong> {{ message.text }}
      </div>
    </div>
    <form @submit.prevent="sendMessage" class="chat-form">
      <input type="text" v-model="newMessage" placeholder="输入消息..." required />
      <button type="submit">发送</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Chat',
  data() {
    return {
      messages: [
        { username: '用户1', text: '你好！' },
        { username: '用户2', text: '欢迎加入聊天室！' }
      ],
      newMessage: ''
    };
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim() !== '') {
        this.messages.push({ username: '我', text: this.newMessage });
        this.newMessage = '';
      }
    }
  }
};
</script>

<style scoped>
.chat-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
}
.messages {
  height: 300px;
  overflow-y: auto;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  padding: 10px;
}
.message {
  margin-bottom: 5px;
}
.chat-form input {
  width: 80%;
  margin-right: 5px;
}
</style>

