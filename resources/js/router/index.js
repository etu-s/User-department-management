import { createRouter, createWebHistory } from "vue-router";

import userIndex from '../components/users/index.vue' //user components
import userCreate from '../components/users/create.vue'
import userEdit from '../components/users/edit.vue'

import departmentIndex from '../components/departments/index.vue'// department components
import departmentCreate from '../components/departments/create.vue'
import departmentEdit from '../components/departments/edit.vue'

import notFound from '../components/NotFound.vue'

const routes = [   //here we define our routes path with crosponding component
    {
        path:'/',
        component: userIndex
    },
    {
        path:'/user/create',
        component: userCreate
    },
    {
        path:'/user/edit/:id',
        component: userEdit,
        props:true
    },
    {
        path:'/department',
        component: departmentIndex
    },
    {
        path:'/department/create',
        component: departmentCreate
    },
    {
        path:'/department/edit/:id',
        component: departmentEdit,
        props:true
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes   // we access defined routes in here then pass router for app.js
})

export default router