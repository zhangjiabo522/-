
import { createRouter, createWebHistory } from 'vue-router';
import Index from '../components/Index.vue';
import Chat from '../components/Chat.vue';

const routes = [
  { path: '/', component: Index },
  { path: '/chat', component: Chat },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
