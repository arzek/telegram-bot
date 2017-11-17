<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent>
            <v-btn color="primary" dark slot="activator">Delete selected ({{ count }})</v-btn>
            <v-card>
                <v-card-title class="headline">Delete selected?</v-card-title>
                <v-card-text>Delete selected ({{count}})</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click.native="dialog = false">Disagree</v-btn>
                    <v-btn color="primary" @click="deleteItems()" >Agree</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import axios from 'axios';

    export default {
        data () {
            return {
                dialog: false
            }
        },
        methods: {
            deleteItems(){
                let component = this;
                axios.post('/users/delete',{users_selected: this.users_selected },{
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(function (response) {
                    let data = [];
                    for(let i = 0; i < component.users.length; i++ ){
                        let status = true;
                        for(let j = 0; j < response.data.length; j++){
                            if(component.users[i].id == response.data[j]){
                                status = false;
                            }
                        }
                        if(status){
                            data.push(component.users[i])
                        }
                    }
                    component.$store.dispatch('setData',data);
                    component.dialog = false;
                }).catch(function (error) {
                    console.log(error);
                    component.dialog = false;
                });
            }
        },
        computed: {
            count() {
                return this.$store.getters.getSelected.length;
            },
            users_selected() {
                return this.$store.getters.getSelected.filter( item => {
                    return item.subscribe == true;
                });
            },
            users(){
                return this.$store.getters.getData;
            }
        }
    }
</script>