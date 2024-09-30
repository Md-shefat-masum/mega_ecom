<template>
    <section class="section_gap">
        <div class="custom-container">
            <div class="section_title">
                <h4 class="text my-2 my-lg-5">Featured Categories</h4>
            </div>
            <div class="top_categries">
                <div v-for="(item, index) in all_category_groups" :key="index" class="category">
                    <Link :href="`/category-group/${item.slug}`" class="category_link">
                    <div class="title">
                        <div class="text-content bn">
                            {{ item.title }}
                        </div>
                    </div>
                    <img :src="load_image(item.image, true)"/>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { use_home_page_store } from '../../Store/home_page_store.js';
import { mapState } from 'pinia';
import Skeleton from '../../../../Components/Skeleton.vue';
export default {
    components: { Skeleton },
    data: () => ({

    }),
    methods: {
        load_image: window.load_image,
    },
    computed: {
        ...mapState(use_home_page_store, {
            all_category_groups: 'all_category_groups',
            all_top_products_offer: 'all_top_products_offer',
            preloader: 'preloader',
        })
    }
}
</script>

<style></style>
