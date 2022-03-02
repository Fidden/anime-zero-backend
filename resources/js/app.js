import notificationMixin from "./mixins/notificationMixin";

require('./bootstrap');
// Components
import BaseHeader from "./components/BaseHeader";
import BaseButton from "./components/BaseButton";
import BaseFooter from "./components/BaseFooter";

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
import modalWindowMixin from "./mixins/modalWindowMixin";

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({el, App, props, plugin}) {
        const app = createApp({
            render: () => h(App, props),
            mixins: [modalWindowMixin, notificationMixin],
        });

        app.component('BaseHeader', BaseHeader)
        app.component('BaseFooter', BaseFooter)
        app.component('BaseButton', BaseButton)
        app.component('InertiaLink', InertiaLink)
        app.use(plugin)
        app.use(VueCropper)
        app.use(ZiggyVue, Ziggy)
        app.mount(el);

        app.config.globalProperties.$axois = axios;
    },
})
