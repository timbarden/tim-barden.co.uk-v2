import './bootstrap';
import './../css/app.css';
import { createApp } from 'vue';
import App from '@/components/App.vue';

import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/pages/Home.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/contact',
            name: 'contact',
            // route level code-splitting
            // this generates a separate chunk (Contact.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import('@/pages/Contact.vue'),
        },
    ],
});

const app = createApp();
app.use(router);
app.component('app', App);
app.mount('#app');