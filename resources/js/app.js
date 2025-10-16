import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import AppLayout from "./layouts/AppLayout.vue";
import {createPinia} from "pinia";

const appName = import.meta.env.VITE_APP_NAME || 'xpresent';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        return page.then((module) => {
            const component = module.default
            component.layout ??= AppLayout
            return module
        })
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(createPinia())
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
