<template>
    <section class="discount-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="discount-banner-contain">
                        <h2>Featured Products</h2>
                        <h1>every <span> discount </span> we <span> offer is the best in market!</span></h1>
                        <div class="rounded-contain">
                            <div class="rounded-subcontain">
                                don't just scroll, your friends have already started buying!
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
                <div v-for="i in products" :key="i.name">
                    <ProductItem :product="i"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import ProductItem from '../../../Components/ProductItem.vue';
export default {
    components: {
        ProductItem,
    },
    data: () => ({
        products: [],
    }),
    created: function () {
        this.get_featured_products();
    },
    methods: {
        get_featured_products: async function () {
            let res = await axios.get('/api/v1/featured-products');
            let data = res.data;
            this.products = data;
        },
    }


}
</script>
