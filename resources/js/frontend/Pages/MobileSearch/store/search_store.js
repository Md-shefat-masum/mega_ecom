import axios from "axios";
import { defineStore } from "pinia";

export const search_store = defineStore("search_store", {
    state: () => ({
        key: '',
        products: [],
    }),
    getters: {},
    actions: {
        search_products: function () {
            axios.get('/search-products?key=' + this.key)
                .then(res => {
                    this.products = res.data.data;
                })
        }
    }
});
