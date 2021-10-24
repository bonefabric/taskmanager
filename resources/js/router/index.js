import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import index from "../components/views/index";

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "index",
            component: index
        },
        {
            path: "/roles",
            name: "roles",
            component: () => import("../components/views/roles")
        }
    ]
});