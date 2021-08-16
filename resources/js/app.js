require('./bootstrap');
// require('alpinejs');

import Vue from 'vue';

Vue.component('ExampleComponent', require('./components/ExampleComponent.vue').default); // one way for importing  and registering component
import Application from "./components/Application.vue"; // only imports the component

// Routing
import Tremendo from "./router";

const app = new Vue({
    el: '#app',
    components: {
        Application // registers the Application component
    },
    router: Tremendo
});
