<template>
    <v-data-table
            v-model="selected"
            v-bind:headers="headers"
            v-bind:items="items"
            select-all
            v-bind:pagination.sync="pagination"
            item-key="name"
            class="elevation-1">
        <template slot="headers" scope="props">
            <tr>
                <th>
                    <v-checkbox
                            success
                            hide-details
                            @click.native="toggleAll"
                            :input-value="props.all"
                            :indeterminate="props.indeterminate">
                    </v-checkbox>
                </th>
                <th class="text-xs-left" v-for="header in props.headers" :key="header.text"
                    :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                    @click="changeSort(header.value)">
                    <v-icon>arrow_upward</v-icon>
                    {{ getHeaderText(header.text) }}
                </th>
            </tr>
        </template>
        <template slot="items" scope="props">
            <tr :active="props.selected" @click="props.selected = !props.selected">
                <td class="text-xs-left">
                    <v-checkbox
                            success
                            hide-details
                            :input-value="props.selected"
                            >
                    </v-checkbox>
                </td>
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.id }}</td>
            </tr>
        </template>
        <template slot="footer">
            <td colspan="100%">
                <template>
                    <div class="text-xs-left">
                        <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
                    </div>
                </template>
                <div class="btn-group">
                    <send-message-component @clearSelected="clearSelected" v-if="count"></send-message-component>
                    <delete-component  @clearSelected="clearSelected" v-if="count"></delete-component>
                </div>
            </td>
        </template>
    </v-data-table>
</template>

<script>
    import SendMessageComponent from './SendMessage.vue';
    import DeleteComponent from './Delete.vue';

    export default {
        mounted() {
            this.$store.dispatch('getDataFromApi');
        },
        data () {
            return {
                pagination: {},
                selected: [],
                headers: [
                    {
                        text: 'Telegram Subscribers',
                        align: 'left',
                        value: 'name'
                    },
                    {
                        text: 'id',
                        value: 'id'
                    }
                ]
            }
        },
        methods: {
            toggleAll () {
                if (this.selected.length) this.selected = [];
                else this.selected = this.items.slice()
            },
            changeSort (column) {
                if (this.pagination.sortBy === column) {
                    this.pagination.descending = !this.pagination.descending;
                } else {
                    this.pagination.sortBy = column;
                    this.pagination.descending = false;
                }
            },
            getHeaderText(text) {
                if(text == 'Telegram Subscribers') {
                    return text + ' ('+ this.coutnAll + ')';
                }else {
                    return text;
                }
            },
            clearSelected (){
                this.selected = [];
                this.count = 0;
                
            }
        },
        computed: {
            pages () {
                return this.pagination.rowsPerPage ? Math.ceil(this.items.length / this.pagination.rowsPerPage) : 0;
            },
            items () {
                return this.$store.getters.getData;
            },
            count() {
                return this.$store.getters.getSelected.length;
            },
            coutnAll(){
                return this.$store.getters.getData.length;
            }
        },
        watch: {
            selected(){ 
                this.$store.dispatch('setSelected',this.selected);
            }
        },
        components: {
            'send-message-component': SendMessageComponent,
            'delete-component': DeleteComponent
        }
    }
</script>