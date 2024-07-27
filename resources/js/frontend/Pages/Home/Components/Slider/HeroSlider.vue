<template>
    <section class="color_bg_banner">
        <div class="custom-container">
            <div class="website_banner">
                <div class="left" id="banner_left">
                    <left-category-list></left-category-list>
                </div>
                <div class="right">
                    <div class="top_banner">
                        <div class="top_banner_left">
                            <Suspense>
                                <template #default>
                                    <LazyComponent />
                                </template>
                                <template #fallback>
                                    <div>Loading...</div>
                                </template>
                            </Suspense>
                        </div>
                        <div class="top_banner_right">
                            <img :src="`${load_image(home_hero_slider_side_banner.banner_one, true)}`" alt="headphone collection" class="w-100" />
                            <!-- <div class="offer-banner-img">
                                <img src="https://themes.pixelstrap.com/bigdeal/assets/images/layout-1/offer-banner.png" alt="offer-banner" class="img-fluid" />
                            </div>
                            <div class="banner-contain">
                                <div>
                                    <a href="product-page(left-sidebar).html">
                                        <h5>Special Offer for you</h5>
                                        <div class="discount-offer">
                                            <h1>50%</h1>
                                            <sup>off</sup>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="bottom_banner">
                        <div class="bottom_banner_left">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_two, true)}`" alt="gadget collection" />
                            </div>
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_three, true)}`" alt="watch collection" />
                            </div>
                        </div>
                        <div class="bottom_banner_right">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_four, true)}`" alt="camera collection" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import { defineAsyncComponent } from 'vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LeftCategoryList from '../Category/LeftCategoryList.vue';
import { mapState } from 'pinia';
import { use_home_page_store } from '../../Store/home_page_store.js';

export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        LeftCategoryList,
        LazyComponent: defineAsyncComponent(() =>
            import('./Slider.vue')
        ),
    },

    methods: {
        load_image: window.load_image,
    },

    computed: {
        ...mapState(use_home_page_store, {
            home_hero_slider_side_banner: 'home_hero_slider_side_banner',
        }),

    },

};
</script>
