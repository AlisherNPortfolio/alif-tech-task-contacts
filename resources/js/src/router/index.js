import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		name: 'home',
        redirect: {name: 'Contacts'},
		component: () => import('./../components/layouts/Home.vue'),
		children: [
			{
				path: 'contacts',
				name: 'Contacts',
				component: () => import('./../views/Contacts.vue'),
			},
		],
	}
];

const router = new VueRouter({
	mode: 'history',
	routes,
	scrollBehavior: () => ({
		y: 0,
	}),
});

export default router;
