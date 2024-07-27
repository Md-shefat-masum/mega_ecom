<template lang="">
    <div>
        <div class="category_modal_toggler" @click="toggle_category">
            <img src="/frontend/images/categories24.svg" alt="">
            <span class="text">
                categories
            </span>
        </div>

        <div class="modal_category_left_side_show modal_category_all_page modal_category">
            <div class="modal_category_all_page_content">
                <div class="parent_categories">
                    <ul>
                        <li
                            v-for="category in parent_categories"
                            :key="category.id">
                            <div class="cat_item"
                                @click="selected = category"
                                :class="{active: selected.id == category.id}">
                                <img :src="`${'/'+category.image}`" :alt="category.title">
                                <span class="link_title">
                                    {{ category.title }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="category_list" :class="{d_grid: nav_categories.length > 10}" >
                    <li class="category_modal_close" @click="close_category">
                        <i class="fa fa-close"></i>
                    </li>
                    <li v-for="category in nav_categories" :key="category.id">
                        <div @click="visit_category(category.slug)">
                            <img :src="'/'+`${category.image}`" :alt="category.title">
                            <span class="link_title">
                                {{ category.title }}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from '@inertiajs/vue3'
export default {

    data: () => ({
        parent_categories: [],
        nav_categories: [],
        selected: {},
    }),
    created: async function () {
        let that = this;
        // setTimeout(function(){
            that.get_nav_categories();
            that.get_categories();
    //     }, 500)
    },
    watch: {
        selected: function () {
            this.get_sub_categories();
        }
    },
    methods: {
        get_sub_categories: async function () {
            let res = await axios.get(`/category/${this.selected.slug}/subcategories`);
            let data = res.data;
            this.nav_categories = data;
        },
        get_nav_categories: async function () {
            let res = await axios.get('/nav-categories');
            let data = res.data;
            this.nav_categories = data;
        },
        get_categories: async function () {
            let res = await axios.get('/all-categories');
            let data = res.data;
            this.parent_categories = data;
        },
        close_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        toggle_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
        visit_category: function (slug) {
            this.close_category();
            router.visit(`/category/${slug}`);
        }
    }
}
</script>
<style lang="">

</style>
