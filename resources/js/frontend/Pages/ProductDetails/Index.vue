<template>

    <Head>
        <title v-if="loaded">
            {{ product_initial_data.title }}
        </title>
    </Head>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>
        <section v-if="loaded" class="section-big-pt-space b-g-light">
            <div class="collection-wrapper">
                <div class="custom-container">
                    <div class="container-fluid">
                        <ProductBasicInfo :product="product_initial_data"></ProductBasicInfo>
                    </div>

                    <ProductBottomDetails :product="product_details"></ProductBottomDetails>
                </div>
            </div>
        </section>
        <section v-else>
            <div class="custom-container">
                <img src="/frontend/images/product_skeleton.png" class="w-100" alt="product-loading">
            </div>
        </section>
        <TopProducts :products="top_products"></TopProducts>
    </Layout>
</template>

<script>

import Layout from "../../Shared/Layout.vue";
import { useProductDetailsStore } from './Store/product_details_store.js';
import ProductBasicInfo from './Components/ProductBasicInfo.vue';
import ProductBottomDetails from './Components/ProductBottomDetails.vue';
import TopProducts from './Components/TopProducts.vue';
import { mapActions, mapState, mapWritableState } from 'pinia';
import ProductImage from './Components/ProductImage.vue';
import BreadCumb from '../../Components/BreadCumb.vue';

export default {
    components: {BreadCumb, Layout, ProductBasicInfo, ProductBottomDetails, TopProducts, ProductImage },
    props: {
        slug: String,
    },
    data: () =>({
        loaded: false,
        product: null,
        bread_cumb: [
            {
                title: 'product-details',
                url: '#',
                active: false,
            },
        ],
    }),
    created: async function () {
        // console.log(this.slug);

        this.product_initial_data = {};

        await this.get_single_product_initial_data(this.slug);
        this.loaded = true;

        await this.get_single_product_details(this.slug);

        let bread_cumb = [];
        this.product_details?.product_categories?.forEach(i=>{
            bread_cumb.push({
                title: i.title,
                url: '/products/'+i.slug,
                active: false,
            })
        });
        bread_cumb.push({
            title: this.product_details.title,
            url: '/product-details/'+this.product_details.slug,
            active: true,
        });
        this.bread_cumb = [...this.bread_cumb, ...bread_cumb];

        await this.get_all_question_and_answers(this.slug);
        await this.get_top_products();
    },
    methods: {
        ...mapActions(useProductDetailsStore, {
            get_single_product_initial_data: "get_single_product_initial_data",
            get_single_product_details: "get_single_product_details",
            get_all_question_and_answers: "get_all_question_and_answers",
            get_top_products: "get_top_products",
        }),
    },
    data: () => ({
        loaded: false,
    }),
    created: async function () {
        await this.set_slug(this.slug);
        await this.get_single_product_initial_data();
        this.loaded = true;
        await this.get_single_product_details();
        // await this.get_top_products();
    },

    computed: {
        ...mapState(useProductDetailsStore, {
            top_products: "top_products",
        }),
        ...mapWritableState(useProductDetailsStore, {
            product_details: 'product_details',
            store_slug: 'slug',
            product_initial_data: 'product_initial_data',
        })
    }
}
</script>

<style scoped>
/* Add your styles here */
</style>
