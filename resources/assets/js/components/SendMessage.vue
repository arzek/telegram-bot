<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent>
            <v-btn color="primary" dark slot="activator">Send message to selected (2)</v-btn>
            <v-card>
                <v-card-title class="headline">Send message?</v-card-title>
                <v-card-text>
                    <v-text-field
                            name="input-1"
                            label="Label Text"
                            textarea
                    ></v-text-field>
                </v-card-text>
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
        }
    }
</script>