import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        data: []
    },
    getters: {
        getData(state) {
            return state.data;
        }
    },
    mutations: {
        set(state,{ items }){
            state.data = items;
        }
    },
    actions: {
        getDataFromApi({commit}) {
            let data = [1,12,3];

            commit('set',{ items: data});
        }
    }
})