import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from "./views/Dashboard";
import ProjectCreate from "./views/ProjectCreate";
import TaskCreate from "./views/TaskCreate";
import ProjectIndex from "./views/ProjectIndex";
import TaskIndex from "./views/TaskIndex";
import ProjectSummary from "./views/ProjectSummary";
import Clocked from "./views/Clocked";
import User from "./components/User";
import Profile from "./views/Profile";
import Logout from "./Actions/Logout";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/dashboard', component: Dashboard
        },
        {
            path: '/project/create', component: ProjectCreate
        },
        {
            path: '/task/create', component: TaskCreate
        },
        {
            path: '/projects', component: ProjectIndex
        },
        {
            path: '/tasks', component: TaskIndex
        },
        {
            path: '/projectsummary/:id', component: ProjectSummary
        },
        {
            path: '/clocked/:id', component: Clocked
        },
        {
            path: '/user', component: User
        },
        {
            path: '/user/:id', component: Profile
        },
        {
            path: '/logout', component: Logout
        }

    ],
    mode: 'history'
});