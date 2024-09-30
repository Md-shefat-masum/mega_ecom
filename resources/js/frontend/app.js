import "../frontend/plugins/sweet_alert.js";
import "../frontend/plugins/axios_setup.js";
import "../frontend/plugins/helper_functions.js";
import { router } from '@inertiajs/vue3'

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { createPinia, mapActions, mapWritableState } from "pinia";
import { common_store } from "./Store/common_store.js";
import { auth_store } from "./Store/auth_store.js";

const pinia = createPinia();

window.page_data = () => JSON.parse(document.querySelector('#app').dataset.page);

window.set_default_data = function () {
    let store_common_action = mapActions(common_store,[
        'get_all_cart_data',
    ])
    let store_common = mapWritableState(common_store, [
        'website_settings_data',
        'all_cart_data',
    ]);
    let auth_store_common = mapWritableState(auth_store, [
        'auth_info',
        'is_auth',
        'role',
    ]);
    let settings = window.page_data().props?.settings;
    let auth_store_data = window.page_data().props?.auth;
    let cart_data = window.page_data().props?.all_cart_data;

    store_common.website_settings_data.set(settings);
    store_common.all_cart_data.set(cart_data);
    auth_store_common.auth_info.set(auth_store_data);
    if(auth_store_data){
        auth_store_common.is_auth.set(true);
        auth_store_common.role.set(auth_store_data.role);
    }

    // store_common_action.get_all_cart_data();
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
        // setTimeout(() => {
        // }, 100);

        app.use(plugin);
        app.component("Link", Link);
        app.component('Head', Head);
        app.mount(el);

    },

});


