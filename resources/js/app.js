import './bootstrap.js';
import Vue from "vue";

import Application from "./Application";

import router from "./router/index.js";
import store from "./store/index.js";

new Vue({
   el: '#app',
   render: h => h(Application),
   router,
   store
});