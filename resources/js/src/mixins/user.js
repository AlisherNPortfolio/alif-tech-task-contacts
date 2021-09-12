export const user = {
    data() {
        return {}
    },
    computed: {
        usersData() {
            return this.users.map(item => {
                            item['phones'] = item.contacts.filter(contact => contact.type === "1");
                            item['emails'] = item.contacts.filter(contact => contact.type === "2");
                            delete item.contacts;

                            return item;
                        });
        }
    }
}
