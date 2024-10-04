<template>
    <Layout>
        <section class="mobile_search_results">
            <div class="custom-container">
                <div class="product_list">
                    <product-item :product="i" v-for="i in products" :key="i.id" />
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { search_store } from "./store/search_store";
import { mapWritableState, mapActions } from "pinia";
import debounce from "debounce";
import ProductItem from "../../Components/ProductItem.vue";

export default {
    components: { Layout , ProductItem},
    methods: {
        ...mapActions(search_store, [
            "search_products",
        ]),
    },
    watch: {
        key: debounce(function (v) {
            this.search_products();
        }, 1000)
    },
    computed: {
        ...mapWritableState(search_store, [
            "key",
            "products",
        ])
    },
};
</script>
