<template>
    <Header />
    <div class="main-wrapper box-shadow">
        <slot />
    </div>
    <Footer />
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import { mapActions } from 'pinia';
import { use_home_page_store } from '../Pages/Home/Store/home_page_store';
export default {
    components: { Header, Footer },
    created: function(){
        this.get_parent_categories();
        this.get_side_nav_categories();
    },
    methods: {
        ...mapActions(use_home_page_store,[
            'get_parent_categories',
            'get_side_nav_categories'
        ])
    }
};
</script>

<style></style>
