import "../frontend/plugins/sweet_alert.js";
import "../frontend/plugins/axios_setup.js";
import "../frontend/plugins/helper_functions.js";
import { router } from '@inertiajs/vue3'

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { createPinia, mapWritableState } from "pinia";
import { common_store } from "./Store/common_store.js";

const pinia = createPinia();

window.page_data = () => JSON.parse(document.querySelector('#app').dataset.page);

window.set_default_data = function () {
    let store_common = mapWritableState(common_store, [
        'website_settings_data',
    ]);
    let settings = window.page_data().props?.settings;
    store_common.website_settings_data.set(settings);
}


createInertiaApp({
    // title: title => title ? `${title} - Ping CRM` : 'Ping CRM',
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props),
        });
        app.use(pinia);
        window.set_default_data();
        
        app.use(plugin);
        app.component("Link", Link);
        app.component('Head', Head);
        app.mount(el);

    },

});


