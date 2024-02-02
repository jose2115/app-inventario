

export default {

    name: '',
    component: () => import(/* webpackChunkName: "daybook" */ '@/modules/daybook/layouts/DayBookLayout.vue'),
    children: [
        
        {
            path: '',
            name: 'Home',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/Home.vue'),
        },
        {
            path: 'productos',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/Productos.vue'),
        },
        {
            path: 'importados',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/files.vue'),
        },
        {
            path: 'inventarios',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/inventarios.vue'),
        },
        {
            path: 'contar',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/contar.vue'),
        },
        {
            path: 'historial',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/Historial.vue'),
        },

        {
            path: 'config',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/ConfigView.vue'),
        },
        
        {
            path: 'perfil',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/ProfileView.vue'),
        },

        {
            path: 'usuarios',
            name: '',
            component: () => import(/* webpackChunkName: "daybook-no-entry" */ '@/modules/daybook/views/UserView.vue'),
        },

    ]

}