import { defineStore } from "pinia";


export const use_home_page_store = defineStore("use_home_page_store", {
    state: () => ({
        home_hero_sliders: [],
        home_hero_slider_side_banner: [],
        side_nav_categories: [],
        parent_categories: [],
        sub_categories: [],
        all_top_products_offer: [],
        all_category_groups: [],
        feature_products: [],
        all_brands: [],
    }),

    actions: {
        get_all_home_hero_sliders: async function () {
            if (this.home_hero_sliders.length > 0) {
                return
            }
            let response = await axios.get('/get-home-page-hero-sliders?get_all=1&is_show=1')
            if (response.data.status === "success") {
                this.home_hero_sliders = response.data.data
            }
        },

        get_all_home_slider_side_banners: async function () {
            if (this.home_hero_slider_side_banner.length > 0) {
                return
            }
            let response = await axios.get('/get-home-page-hero-slider-side-banners')
            if (response.data.status === "success") {
                this.home_hero_slider_side_banner = response.data.data
            }
        },
        get_side_nav_categories: async function () {
            if (this.side_nav_categories.length > 0) {
                return
            }
            let res = await axios.get('/nav-categories');
            let data = res.data;
            this.side_nav_categories = data;
        },
        get_parent_categories: async function () {
            if (this.parent_categories.length > 0) {
                return
            }
            let res = await axios.get('/all-categories');
            let data = res.data;
            this.parent_categories = data;
        },
        get_sub_categories: async function (slug) {
            let res = await axios.get(`/category/${slug}/subcategories`);
            let data = res.data;
            this.sub_categories = data;
        },


        get_all_top_products_offer: async function () {
            if (this.all_top_products_offer.length > 0) {
                return
            }
            let response = await axios.get('/get-all-top-product-offer?get_all=1')
            if (response.data.status === "success") {
                this.all_top_products_offer = response.data.data
            }
        },

        get_all_category_groups: async function () {
            if (this.all_category_groups.length > 0) {
                return
            }
            let response = await axios.get('/get-all-category-groups?get_all=1')
            if (response.data.status === "success") {
                this.all_category_groups = response.data.data
            }
        },

        get_all_featured_products: async function () {
            if (this.feature_products.length > 0) {
                return
            }
            let res = await window.publicAxios("/featured-products");
            this.feature_products = res;
        },

        get_all_brands: async function () {
            if (this.all_brands.length > 0) {
                return
            }
            let response = await axios.get('/brands')
            if (response.data.status === "success") {
                this.all_brands = response.data?.data
            }
        },

    },
});
