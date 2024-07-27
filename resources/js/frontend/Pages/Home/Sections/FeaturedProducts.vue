<template>
    <section class="discount-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="discount-banner-contain">
                        <h2>Featured Products</h2>
                        <h1>
                            every <span> discount </span> we
                            <span> offer is the best in market!</span>
                        </h1>
                        <div class="rounded-contain">
                            <div class="rounded-subcontain">
                                don't just scroll, your friends have already
                                started buying!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 py-5">
        <div class="custom-container">
            <div class="product_list">
                <div v-for="product in feature_products" :key="product.name">
                    <ProductItem :product="product" />
                </div>
            </div>
        </div>
    </section>

</template>

<script>

import ProductItem from "../../../Components/ProductItem.vue";
import { use_home_page_store } from "../Store/home_page_store.js";
import { mapState } from "pinia";
export default {

    components: {
        ProductItem,
    },
    computed: {
        ...mapState(use_home_page_store, {
            feature_products: "feature_products",
        }),
    },
};
</script>
