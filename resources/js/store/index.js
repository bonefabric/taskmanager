import Vue from "vue";
import Vuex from "vuex"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        application: {
            roles: {
                data: [],
                loaded: false,
            },
        }
    },
    getters: {
        application_roles_data: state => state.application.roles.data,
        application_roles_loaded: state => state.application.roles.loaded,
    },
    mutations: {
        application_roles_add: (state, role) => state.application.roles.data.push(role),
        application_roles_setLoaded: (state, loaded = true) => state.application.roles.loaded = loaded,
    },
    actions: {
        async application_roles_load(context) {
            const data = await axios.get('api/v1/roles');
            data.data.forEach(item => context.commit("application_roles_add", item));
            context.commit("application_roles_setLoaded");
        }
    }
});