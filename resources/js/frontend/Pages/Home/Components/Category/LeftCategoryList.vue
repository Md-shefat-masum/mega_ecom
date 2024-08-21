<template>

    <div class="modal_category_left_side_show">

        <ul class="category_list">
            <li class="category_modal_close" @click="close_category">
                <i class="fa fa-close"></i>
            </li>
            <li v-for="category in side_nav_categories" :key="category.id">
                <Link :href="`/products/${category.slug}`">
                <img :src="load_image(`${category.image}`)" :alt="category.title">
                <span class="link_title">
                    {{ category.title }}
                </span>
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>

import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState } from 'pinia';

export default {
    methods: {
        close_category: function () {
            document.querySelector('.modal_category_left_side_show').classList.toggle('modal_category');
            document.querySelector('.modal_category_left_side_show').classList.toggle('active');
        },
        load_image: window.load_image,
    },
    computed: {
        ...mapState(use_home_page_store, {
            side_nav_categories: "side_nav_categories",
            preloader: 'preloader',
        }),
    },
}
</script>
