import Vue from 'vue'
import Notifications from 'vue-notification'

// documentation: https://www.npmjs.com/package/vue-notification
Vue.use(Notifications);

Vue.prototype.$notification = {
    error(text) {
        Vue.prototype.$notify({
            text,
            type: 'error'
        })
    }
}
