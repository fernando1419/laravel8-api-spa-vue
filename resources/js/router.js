import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Application from "./components/Application.vue";
import ExampleComponent from "./components/ExampleComponent.vue";

const routes = [
    {
        path: "/",
        component: Application,
        alias: ['/home', '/main'], // renders the Application componennt for "/"" and also for "/home"
        name: "home"
    },
    {
        path: "/example",
        component: ExampleComponent,
        name: "example"
    }
];

export default new VueRouter({
    routes,
    mode: 'history'
});
