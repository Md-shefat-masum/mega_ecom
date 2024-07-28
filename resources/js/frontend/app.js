import "../frontend/plugins/sweet_alert.js";
import "../frontend/plugins/axios_setup.js";
import "../frontend/plugins/helper_functions.js";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { createPinia } from "pinia";

const pinia = createPinia();

window.page_data = () => JSON.parse(document.querySelector('#app').dataset.page);

let window_width = window.innerWidth;

createInertiaApp({
    // title: title => title ? `${title} - Ping CRM` : 'Ping CRM',
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(pinia);
        app.component("Link", Link);
        app.component('Head', Head);
        app.mount(el);
    },
});

