import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

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

            axios.get('/users',{
               headers: {
                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
               }
            }).then(function (response) {
                commit('set',{ items: response.data});
            }).catch(function (error) {
                   console.log(error);
            });
        }
    }
})