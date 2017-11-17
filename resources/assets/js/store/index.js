import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        data: [],
        selected: []
    },
    getters: {
        getData(state) {
            return state.data;
        },
        getSelected(state) {
            return state.selected;
        }
    },
    mutations: {
        setData(state,{ items }){
            state.data = items;
        },
        setSelected(state,{ selected }){
            state.selected = selected;
        },
    },
    actions: {
        setData({commit},data){
            commit('setData',{ items: data});
        },
        getDataFromApi({commit}) {

            axios.get('/users',{
               headers: {
                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
               }
            }).then(function (response) {
                commit('setData',{ items: response.data});
            }).catch(function (error) {
                   console.log(error);
            });
        },
        setSelected({commit},selected){
            commit('setSelected',{ selected: selected});
        }
    }
})