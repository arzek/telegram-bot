<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent>
            <v-btn color="primary" dark slot="activator">Send message to selected ( {{ count }} )</v-btn>
            <v-card>
                <v-card-title class="headline">Send message?</v-card-title>
                <v-card-text>
                    <v-text-field
                            name="input-1"
                            label="Text message"
                            v-model="text"
                            textarea
                            autofocus
                    ></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click.native="dialog = false;text = '';">Disagree</v-btn>
                    <v-btn color="primary" @click="sendMessage()" v-if="text">Agree</v-btn>
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
                text: '',
                dialog: false
            }
        },
        methods: {
            sendMessage(){
                let component = this;
                axios.post('/users/send',{ text: this.text , users_selected: this.users_selected },{
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(function (response) {
                    console.log(response);
                    component.dialog = false;
                    component.text = '';
                    component.$emit('clearSelected');
                }).catch(function (error) {
                    console.log(error);
                    component.dialog = false;
                    component.text = '';
                    component.$emit('clearSelected');
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
            }
        }
    }
</script>