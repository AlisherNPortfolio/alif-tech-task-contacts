export const user = {
    data() {
        return {}
    },
    computed: {
        usersData() {
            return this.users.map(item => {
                            item['phones'] = item.contacts.filter(contact => contact.type === "PHONE");
                            item['emails'] = item.contacts.filter(contact => contact.type === "EMAIL");
                            delete item.contacts;

                            return item;
                        });
        }
    }
}
