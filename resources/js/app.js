import Layout from "./Layout";

require('./bootstrap');
// Components
import BaseButton from "./components/BaseButton";


// Packets
import {createApp, getCurrentInstance, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3/src";
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue';
import {Ziggy} from 'ziggy';
import axios from "axios";
import 'vue-cropper/dist/index.css';
import VueCropper from "vue-cropper";

//Mixins
import modalWindowMixin from "./mixins/ModalWindowMixin";
import notificationMixin from "./mixins/NotificationMixin";

createInertiaApp({
    resolve: name => {
        const page = require(`./pages/${name}`).default;
        page.layout = page.layout || Layout;
        return page;
    },
    setup({el, App, props, plugin}) {
        const app = createApp({
            render: () => h(App, props),
            mixins: [modalWindowMixin, notificationMixin],
        });

        app.component('BaseButton', BaseButton)
        app.component('InertiaLink', InertiaLink)

        app.use(plugin)
        app.use(VueCropper)
        app.use(ZiggyVue, Ziggy)
        app.mount(el);

        app.config.globalProperties.$axois = axios;
    },
})
