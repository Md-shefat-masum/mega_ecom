<template>
    <layout>

        <Head>
            <title>
                {{ product_initial_data?.title }}
            </title>
        </Head>

        <section v-if="preloader">
            <div class="custom-container">
                <img src="/frontend/images/product_skeleton.png" class="w-100" alt="product-loading">
            </div>
        </section>
        <section v-else>

            <template v-if="product_details.type == 'medicine'">
                <medicine-product></medicine-product>
            </template>
            <template v-if="product_details.type == 'product'">
                <general-product></general-product>
            </template>

            <TopProducts :products="top_products"></TopProducts>
        </section>


    </layout>
</template>

<script>

import Layout from "../../Shared/Layout.vue";
import BreadCumb from '../../Components/BreadCumb.vue';
import MedicineProduct from './MedicineProduct.vue';
import GeneralProduct from './GeneralProduct.vue';
import { useProductDetailsStore } from './Store/product_details_store.js';
import { mapActions, mapState, mapWritableState } from 'pinia';
import TopProducts from './Components/TopProducts.vue';

export default {
    components: { MedicineProduct, GeneralProduct, BreadCumb, Layout, TopProducts, },
    props: {
        slug: String,
    },
    data: () => ({
        preloader: true,
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
        await this.set_slug(this.slug);

        this.product_initial_data = {};

        await this.get_single_product_initial_data(this.slug);

        await this.get_single_product_details(this.slug);


        let bread_cumb = [];

        this.product_details?.product_categories?.forEach(i => {
            bread_cumb.push({
                title: i.title,
                url: '/products/' + i.slug,
                active: false,
            })
        });

        bread_cumb.push({
            title: this.product_details.title,
            url: '/product-details/' + this.product_details.slug,
            active: true,
        });

        this.bread_cumb = [...this.bread_cumb, ...bread_cumb];

        await this.get_all_question_and_answers(this.slug);


        await this.get_top_products();

        this.preloader = false;

    },
    methods: {

        ...mapActions(useProductDetailsStore, {
            get_single_product_initial_data: "get_single_product_initial_data",
            get_single_product_details: "get_single_product_details",
            get_all_question_and_answers: "get_all_question_and_answers",
            get_top_products: "get_top_products",
            set_slug: "set_slug",
        }),

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


};
</script>

<style scoped>
/* Add your styles here */
</style>
