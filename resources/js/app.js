import BaseHeader from "./components/BaseHeader";

require('./bootstrap');
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3/src";
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue';
import { Ziggy } from 'ziggy';


createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)});

        app.component('BaseHeader', BaseHeader)
        app.component('InertiaLink', InertiaLink)
        app.use(plugin)
        app.use(ZiggyVue, Ziggy)
        app.mount(el)
    },
})
