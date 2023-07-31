
// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import { InertiaProgress } from '@inertiajs/progress'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueMeta from 'vue-meta'
import VueRouter from 'vue-router'

import StatusMessages from '@frontend/Components/StatusMessages'
Vue.component('StatusMessages', StatusMessages)

import ImagePreview from '@frontend/Components/ImagePreview'
Vue.component('ImagePreview', ImagePreview)

import Pagination from '@frontend/Components/Pagination'
Vue.component('Pagination', Pagination)

import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);

import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
Vue.component('VueSlickCarousel', VueSlickCarousel)

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

// // Font Awesome
import 'admin-lte/plugins/fontawesome-free/css/brands.min.css';
import 'admin-lte/plugins/fontawesome-free/css/regular.min.css';
import 'admin-lte/plugins/fontawesome-free/css/solid.min.css';
import 'admin-lte/plugins/fontawesome-free/css/fontawesome.min.css';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)
Vue.use(VueMeta, {
  // optional pluginOptions
  refreshOnceOnNavigation: true
})

InertiaProgress.init({
	delay: 0,
	color: '#ff0000',
	includeCSS: true,
	showSpinner: false,
})

const app = document.getElementById('app');
const router = new VueRouter({
    mode: 'history',
});

window.app = new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
        router
}).$mount(app);
