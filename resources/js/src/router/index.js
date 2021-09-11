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
				component: () => import('./../views/contacts'),
                children: [
                    {
                        path: '',
                        name: 'contact-index',
                        component: () => import('./../views/contacts/Contacts')
                    },
                    {
                        path: 'create',
                        name: 'contact-create',
                        component: () => import('./../views/contacts/AddEditContact')
                    },
                    {
                        path: ':id',
                        name: 'contact-update',
                        component: () => import('./../views/contacts/AddEditContact')
                    }
                ]
			}
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
