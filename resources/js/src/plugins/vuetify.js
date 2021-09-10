import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify);

export default new Vuetify({
	icons: {
		iconfont: 'mdiSvg' || 'mdi',
	},
	theme: {
		themes: {
			light: {
				primary: '#2565e5',
				secondary: '#71D0FD',
				success: '#6DD230',
				danger: '#FF5F68',
			},
		},
	},
});
