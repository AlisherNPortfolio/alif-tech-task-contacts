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
                    :items="contacts"
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
            </v-col>
        </v-row>
    </v-container>

</template>
<script>
export default {
    name: 'Contacts',
    data() {
        return {
            headers: [
                { text: 'First name', value: 'first_name' },
                { text: 'Last name', value: 'last_name' },
                { text: 'Phones', value: 'phones' },
                { text: 'Emails', value: 'emails' },
                { text: 'Action', value: 'action'}
            ],
            contacts: []
        }
    },
    created() {
        this.load();
    },
    methods: {
        load() {
            const contacts = [
                {
                    id: 1,
                    first_name: 'Alisher',
                    last_name: 'Nasrullayev',
                    phones: [
                        {
                            id: 1,
                            user_id: 1,
                            type: 1,
                            contact: '998909289445'
                        },
                        {
                            id: 2,
                            type: 1,
                            user_id: 2,
                            contact: '998945546535'
                        }
                    ],
                    emails: [
                        {
                            id: 3,
                            user_id: 1,
                            type: 2,
                            contact: 'myemail9445@inbox.ru'
                        },
                        {
                            id: 4,
                            user_id: 1,
                            type: 2,
                            contact: 'ali1289445@gmail.com'
                        }
                    ]
                },
                {
                    id: 2,
                    first_name: 'Barnogul',
                    last_name: 'Hamidova',
                    phones: [
                        {
                            id: 5,
                            user_id: 2,
                            type: 1,
                            contact: '998912518065'
                        }
                    ],
                    emails: [
                        {
                            id: 6,
                            user_id: 2,
                            type: 2,
                            contact: 'test@mail.uz'
                        }
                    ]
                }
            ];
            this.contacts = contacts;
        },
        edit(item) {

        },
        remove(item) {

        }
    }
}
</script>
<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>
