import Vue from 'vue';
import VueRouter from 'vue-router';
import TaskCreate from "./views/TaskCreate";
import TasksIndex from "./views/TasksIndex";
import TaskEdit from "./views/TaskEdit";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/tasks', component: TasksIndex
        },
        {
            path: '/task/:id/edit', component: TaskEdit
        }
    ],
    mode: 'history'
});