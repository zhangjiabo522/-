
<template>
  <div class="container">
    <h1>欢迎使用 JB 聊天室</h1>
    <h3>我们的特点</h3>
    <ul>
      <li>✔ 定时清除聊天记录</li>
      <li>✔ 聊天记录加密算法</li>
      <li>✔ 用户隐私哈希加密</li>
      <li>✔ 防止注入守护安全</li>
    </ul>
    <form @submit.prevent="handleLogin" class="form">
      <input type="text" v-model="username" placeholder="用户名" required />
      <input type="password" v-model="password" placeholder="密码" required />
      <button type="submit">登录</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Index',
  data() {
    return {
      username: '',
      password: ''
    };
  },
  methods: {
    handleLogin() {
      // Perform login action, replace with actual API call if needed
      alert(`登录成功：${this.username}`);
    }
  }
};
</script>

<style scoped>
.container {
  text-align: center;
  margin-top: 50px;
}
.form input {
  margin: 5px;
}
</style>
