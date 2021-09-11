<template>
    <v-container>
        <v-form
            ref="contactForm"
            v-model="valid"
            lazy-validation>
            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="contactForm.first_name"
                        :counter="15"
                        :rules="nameRules"
                        label="First name"
                        required
                        ></v-text-field>
                </v-col>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="contactForm.last_name"
                        :counter="15"
                        :rules="nameRules"
                        label="Last name"
                        required
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="3">
                    <v-row>
                        <v-col>
                            <v-btn block @click="addContact('phone')">
                                + Add phone
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row v-for="(ph, idx) in phone" :key="idx">
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="ph.contact"
                                :counter="13"
                                :rules="phoneRules"
                                label="Phone number"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-btn
                                color="danger"
                                fab
                                small
                                dark
                                @click="removeContact('phone', ph)"
                                >
                                <v-icon>mdi-minus</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col cols="12" md="3">
                    <v-row>
                        <v-col>
                            <v-btn block @click="addContact('email')">
                                + Add email
                            </v-btn>
                        </v-col>
                    </v-row>
                     <v-row v-for="(em, idx) in email" :key="idx">
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="em.contact"
                                :rules="emailRules"
                                label="Email"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-btn
                                color="danger"
                                fab
                                small
                                dark
                                @click="removeContact('email', em)"
                                >
                                <v-icon>mdi-minus</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6">
                    <v-row>
                        <v-col align="end">
                            <v-btn
                                depressed
                                color="primary"
                                @click="send()"
                                >
                                Primary
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>
<script>
export default {
    name: 'AddEditContact',
    data() {
        return {
            contactForm: {
                first_name: null,
                last_name: null,
                contacts: [],
            },
            phone: [],
            email: [],
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 15) || 'Name must be less than 15 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            phoneRules: [
                v => !!v || 'Phone number is required',
                v => /(?:\+[9]{2}[8][0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2})/g.test(v) || 'Invalid phone number'
            ],
            valid: true
        }
    },

    methods: {
        addContact(type) {
            if (!this[type].every(item => !!item.contact)) return;

            this[type].push({type: type, contact: null});
        },
        removeContact(type, item) {
            if (this[type].includes(item)) {
                this[type] = this[type].filter(
                                    ct => ct.contact !== item.contact
                                );
            }
        },
        send() {
            this.contactForm.contacts = [...this.phone, ...this.email];
            this.removeDuplicateContacts();

            this.$api.get('test')
            .then(response => {
                console.log(response)
            })
        },
        removeDuplicateContacts() {
            this.contactForm.contacts = Array.from(
                    new Set(
                            this.contactForm.contacts
                        )
                    )
        }
    },
}
</script>
