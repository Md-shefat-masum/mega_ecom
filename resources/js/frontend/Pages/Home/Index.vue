<template>
    <Layout>
        <Head>
            <title>ETEK Enterprise - Leading Electronics and Gadgets</title>
        </Head>
        <HeroSlider />

        <BreakingNews />

        <TopCategories />

        <OurServiceType />

        <FeaturedProducts />

        <Brands />

        <JoinNewsLetter />

        <BottomDescription />
    </Layout>

</template>
<script>
import Layout from "../../Shared/Layout.vue";
import HeroSlider from "./Components/Slider/HeroSlider.vue";
import BreakingNews from "./Sections/BreakingNews.vue";
import TopCategories from "./Components/Category/TopCategories.vue";
import OurServiceType from "../../Components/OurServiceType.vue";
import FeaturedProducts from "./Sections/FeaturedProducts.vue";
import BottomDescription from "./Sections/BottomDescription.vue";
import Brands from "./Sections/Brands.vue";
import JoinNewsLetter from "./Sections/JoinNewsLetter.vue";

import { mapActions, mapState } from 'pinia';
import {use_home_page_store} from "./Store/home_page_store";

export default {
    components: {
        Layout,
        HeroSlider,
        BreakingNews,
        TopCategories,
        OurServiceType,
        FeaturedProducts,
        BottomDescription,
        Brands,
        JoinNewsLetter,
    },

    created: async function () {
        // await this.get_side_nav_categories()
        await this.get_all_home_hero_sliders()
        await this.get_home_slider_side_banner()
        // await this.get_parent_categories()
        await this.get_all_top_products_offer()
        await this.get_all_category_groups()
        await this.get_all_featured_products()
        await this.get_all_brands()
    },

    methods: {
        ...mapActions(use_home_page_store,{
            get_all_home_hero_sliders: "get_all_home_hero_sliders",
            get_home_slider_side_banner: "get_all_home_slider_side_banners",
            get_side_nav_categories: "get_side_nav_categories",
            get_parent_categories: "get_parent_categories",
            get_all_top_products_offer: "get_all_top_products_offer",
            get_all_category_groups: "get_all_category_groups",
            get_all_featured_products: "get_all_featured_products",
            get_all_brands: "get_all_brands",
        })
    },


};
</script>
<style lang="scss" scoped></style>
