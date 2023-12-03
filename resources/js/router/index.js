import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/:pathMatch(.*)*",
        name: 'notFound',
        component: () => import ('../../vue/pages/errors/404.vue')
    },
    {
        path: '/',
        name: 'EmployeeIndex',
        component: () => import ('../../vue/pages/empoyees/EmployeeIndex.vue')
    },
    {
        path: '/employee',
        name: 'EmployeeRegister',
        component: () => import ('../../vue/pages/empoyees/EmployeeRegister.vue')
    },
    {
        path: '/employee/:id',
        name: 'EmployeeEdit',
        component: () => import ('../../vue/pages/empoyees/EmployeeEdit.vue')
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
