<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent>
            <v-btn color="primary" dark slot="activator">Delete selected ( {{ count }})</v-btn>
            <v-card>
                <v-card-title class="headline">Delete selected?</v-card-title>
                <v-card-text>Delete selected (2)</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click.native="dialog = false">Disagree</v-btn>
                    <v-btn color="primary" @click.native="dialog = false">Agree</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        data () {
            return {
                dialog: false
            }
        },
        computed: {
            count() {
                return this.$store.getters.getSelected.length;
            }
        }
    }
</script>