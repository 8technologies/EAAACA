require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import { InertiaProgress } from '@inertiajs/progress'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueMeta from 'vue-meta'
import VueRouter from 'vue-router'
import CKEditor from '@ckeditor/ckeditor5-vue2';

import EntityLinks from '@/Pages/Core/_Includes/_EntityLinks'
Vue.component('EntityLinks', EntityLinks)

import HighchartsVue from 'highcharts-vue'
Vue.use(HighchartsVue)

import StatusMessages from '@/Components/StatusMessages'
Vue.component('StatusMessages', StatusMessages)

import ImagePreview from '@frontend/Components/ImagePreview'
Vue.component('ImagePreview', ImagePreview)

import Pagination from '@frontend/Components/Pagination'
Vue.component('Pagination', Pagination)

import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.min.css';
Vue.use(datePicker);
jQuery.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
      time: 'far fa-clock',
      date: 'far fa-calendar',
      up: 'fas fa-arrow-up',
      down: 'fas fa-arrow-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right',
      today: 'fas fa-calendar-check',
      clear: 'far fa-trash-alt',
      close: 'far fa-times-circle'
    }
});

import './Plugins/bootstrap-table.js'

// Font Awesome
import 'admin-lte/plugins/fontawesome-free/css/brands.min.css';
import 'admin-lte/plugins/fontawesome-free/css/regular.min.css';
import 'admin-lte/plugins/fontawesome-free/css/solid.min.css';
import 'admin-lte/plugins/fontawesome-free/css/fontawesome.min.css';
// Other Styles
import 'admin-lte/dist/css/adminlte.min.css';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

// import '../src/bootstrap/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { Callbacks } from 'jquery';
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)
Vue.use(VueMeta, {
  // optional pluginOptions
  refreshOnceOnNavigation: true
})

import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);

import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
Vue.component('VueSlickCarousel', VueSlickCarousel)

Vue.use(CKEditor);

// import ResponsiveImage from '@/Components/ResponsiveImage'
// Vue.component('ResponsiveImage', ResponsiveImage)

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
                resolveComponent: (name) => {
                    try {
                        return require(`@/Pages/${name}`).default
                    } catch (error) {
                        return require(`@frontend/Pages/${name}`).default
                        // console.log(`Module Doesn't exist`)
                    }
                },
            },
        }),
        router
}).$mount(app);
