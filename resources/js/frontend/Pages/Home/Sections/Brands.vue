<template>
    <section class="brands">
        <div class="custom-container">
            <h2 class="title">Brands We Are Working With</h2>
            <ul class="brand_items">
                <li v-for="item in brands" :key="item.id">
                    <template v-if="item.image">
                        <img :src="check_image_url(item.image)" :alt="item.title">
                    </template>

                    <template v-else>
                        <div class="no-image d-flex align-items-center justify-content-center">
                            {{ item.title }}
                        </div>
                    </template>

                </li>
            </ul>
        </div>
    </section>
</template>
<script>

import { mapState } from 'pinia';
import { use_home_page_store } from '../Store/home_page_store.js';

export default {

    methods: {
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return "/" + url;
            }
        },
    },

    computed: {
        ...mapState(use_home_page_store, {
            brands: "all_brands",
        }),
    },
}
</script>

<style>
.no-image {
    width: 100px;
    height: 100px;
    background: #e2e2e2;
    border-radius: 50%;

}
</style>
