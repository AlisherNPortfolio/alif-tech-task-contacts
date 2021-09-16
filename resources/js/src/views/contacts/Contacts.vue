<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="4">
                <router-link to="/contacts/create">
                    <v-btn
                        class="mx-2"
                        small
                        color="secondary"
                    >
                        <v-icon dark>
                            mdi-plus
                        </v-icon>
                        Add
                    </v-btn>
                </router-link>
            </v-col>
            <v-col cols="12" md="8">
                <v-row>
                    <v-col cols="12" md="3">
                        <v-text-field
                            v-model="query.first_name"
                            label="First name"
                            hide-details="auto"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            v-model="query.last_name"
                            label="Last name"
                            hide-details="auto"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-text-field
                            v-model="query.phone"
                            label="Phone"
                            hide-details="auto"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-text-field
                            v-model="query.email"
                            label="Email"
                            hide-details="auto"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-btn
                        class="mx-2"
                        small
                        fab
                        dark
                        color="indigo"
                        @click="load"
                    >
                        <v-icon>
                            mdi-magnify
                        </v-icon>
                    </v-btn>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-data-table
                    :headers="headers"
                    :items="usersData"
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
                            @click="edit(item.id)">
                                mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            @click="remove(item.id)">
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
import {user} from './../../mixins/user';

export default {
    name: 'Contacts',
    data() {
        return {
            query: {
                first_name: null,
                last_name: null,
                phone: null,
                email: null,
                page: 1
            },
            headers: [
                { text: 'First name', value: 'first_name' },
                { text: 'Last name', value: 'last_name' },
                { text: 'User name', value: 'unique_name' },
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
    mixins: [user],
    methods: {
        load() {
            this.$api.get('user', {params: this.query})
            .then(response => {
                const data = response.data.users;

                this.users = data.data;
                this.total = data.total;

            }, error => console.log(error))
        },
        edit(id) {
            this.$router.push({name: 'contact-update', params: {id: id}});
        },
        remove(id) {
            this.$api.delete(`user/${id}`)
            .then(response => {
                console.log(response)
                this.$notify({type: 'success', text: 'Deleted successfully!'})
                this.load();
            }, error => console.log(error))
        },
        pagination(page) {
            this.query.page = page;
            this.load();
        }
    }
}
</script>
<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>
