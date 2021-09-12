<template>
    <v-container>
        <v-row>
            <v-col>
                <router-link to="/contacts/create">
                    <v-btn
                        class="mx-2"
                        small
                        fab
                        dark
                        color="indigo"
                    >
                        <v-icon dark>
                            mdi-plus
                        </v-icon>
                    </v-btn>
                </router-link>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-data-table
                    :headers="headers"
                    :items="usersList"
                    :hide-default-footer="true"
                    sort-by="calories"
                    class="elevation-1"
                    >
                    <template v-slot:[`item.phones`]="{item}">
                        <v-expansion-panels>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    Phones
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-list>
                                        <v-list-item-group color="primary">
                                            <v-list-item v-for="(phone, idx) in item.phones" :key="idx">
                                                <v-list-item-content>
                                                    {{ phone.contact }}
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list-item-group>
                                    </v-list>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </template>
                    <template v-slot:[`item.emails`]="{item}">
                        <v-expansion-panels>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    Emails
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-list>
                                        <v-list-item-group>
                                            <v-list-item v-for="(email, idx) in item.emails" :key="idx">
                                                <v-list-item-content>
                                                    {{ email.contact }}
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list-item-group>
                                    </v-list>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </template>
                    <template v-slot:[`item.action`]="{ item }">
                        <v-icon
                            small
                            class="mr-2"
                            @click="edit(item)">
                                mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            @click="remove(item)">
                                mdi-delete
                        </v-icon>
                    </template>
                </v-data-table>
                <pagination
                    :total="this.total"
                    :perPage="10"
                    @paginate="pagination($event)">
                </pagination>
            </v-col>
        </v-row>
    </v-container>

</template>
<script>
import Pagination from './../../components/shared-components/Pagination';

export default {
    name: 'Contacts',
    data() {
        return {
            query: {
                page: 1
            },
            headers: [
                { text: 'First name', value: 'first_name' },
                { text: 'Last name', value: 'last_name' },
                { text: 'Phones', value: 'phones' },
                { text: 'Emails', value: 'emails' },
                { text: 'Action', value: 'action'}
            ],
            users: [],
            total: 0
        }
    },
    components: {Pagination},
    created() {
        this.load();
    },
    methods: {
        load() {
            this.$api.get('user', {params: this.query})
            .then(response => {
                const data = response.data.users;

                this.users = data.data;
                this.total = data.total;

            }, error => console.log(error))
        },
        edit(item) {
            console.log(this.usersList)
        },
        remove(item) {

        },
        pagination(page) {
            this.query.page = page;
            this.load();
        }
    },
    computed: {
        usersList() {
            return this.users.map(item => {
                            item['phones'] = item.contacts.filter(contact => contact.type === "1");
                            item['emails'] = item.contacts.filter(contact => contact.type === "2");
                            delete item.contacts;

                            return item;
                        });
        }
    }
}
</script>
<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>
