<template>
    <v-app id="inspire">
        <v-toolbar color="primary" dark fixed app>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-toolbar>
        <main>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout justify-center align-center>
                        <table-component></table-component>
                    </v-layout>
                </v-container>
            </v-content>
        </main>
        <v-footer color="primary" app>
            <span class="white--text">&copy; Arzek</span>
        </v-footer>
    </v-app>
</template>

<script>
    import TableComponent from './components/TableComponent.vue';

    export default {
        components: {
            'table-component': TableComponent
        }
    }
</script>
