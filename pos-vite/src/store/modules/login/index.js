import Getters from './getters.js';
import Mutations from './mutations.js';
import Actions from './actions.js';

export default {
    namespaced :true,
    state() {
        return ({ isLoggedIn: false, });
    },
    actions: Actions,
    mutations: Mutations,
    getters: Getters,
};