require('./bootstrap');
import Vue from "vue";

import Application from "./Application";

import router from "./router";
import store from "./store";

new Vue({
   el: '#app',
   render: h => h(Application),
   router,
   store
});