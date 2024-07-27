<template>

    <Head>
        <title v-if="loaded">
            {{ product_initial_data.title }}
        </title>
    </Head>
    <Layout>
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
import { onMounted, computed } from 'vue';
import Layout from "../../Shared/Layout.vue";
import { useProductDetailsStore } from './Store/product_details_store.js';
import ProductBasicInfo from './Components/ProductBasicInfo.vue';
import ProductBottomDetails from './Components/ProductBottomDetails.vue';
import TopProducts from './Components/TopProducts.vue';
import { mapActions, mapState } from 'pinia';

export default {
    components: { Layout, ProductBasicInfo, ProductBottomDetails, TopProducts },
    props: {
        slug: String,
    },
    // setup(props) {

    //     // const productDetailsStore = useProductDetailsStore();
    //     // productDetailsStore.slug = props.slug;

    //     // const product_initial_data = computed(() => productDetailsStore.product_initial_data);
    //     // const product_details = computed(() => productDetailsStore.product_details);
    //     // const top_products = computed(() => productDetailsStore.top_products);

    //     onMounted(async () => {
    //         // await productDetailsStore.get_single_product_initial_data();
    //         // await productDetailsStore.get_single_product_details();
    //         // await productDetailsStore.get_top_products();
    //     });


    //     return {};

    // },
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
    methods: {
        ...mapActions(useProductDetailsStore, [
            'get_single_product_initial_data',
            'get_single_product_details',
            'get_top_products',
            'set_slug',
        ])
    },
    computed: {
        ...mapState(
            useProductDetailsStore,
            [
                'product_initial_data',
                'product_details',
                'top_products',
            ]
        ),
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>
