require('./bootstrap');
import Components from 'laravel-mix/src/components/Components';
// require('alpinejs');

import Vue from 'vue';

Vue.component('ExampleComponent', require('./components/ExampleComponent.vue').default); // one way for importing  and registering component
// import ExampleComponent from "./components/ExampleComponent.vue"; // only imports the component

const app = new Vue({
    el: '#app',
    //    components: {
    //        ExampleComponent // registers it.
    //    }
});
