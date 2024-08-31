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
                            <slider></slider>
                        </div>
                        <div class="top_banner_right">
                            <img :src="`${load_image(home_hero_slider_side_banner.banner_one, true)}`"
                                alt="headphone collection" 
                                class="w-100" />
                        </div>
                    </div>

                    <div class="bottom_banner">
                        <div class="bottom_banner_left">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_two, true)}`"
                                    alt="gadget collection" />
                            </div>
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_three, true)}`"
                                    alt="watch collection" />
                            </div>
                        </div>
                        <div class="bottom_banner_right">
                            <div class="img">
                                <img :src="`${load_image(home_hero_slider_side_banner.banner_four, true)}`"
                                    alt="camera collection" />
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
import Slider from './Slider.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LeftCategoryList from '../Category/LeftCategoryList.vue';
import { mapState } from 'pinia';
import { use_home_page_store } from '../../Store/home_page_store.js';
import Skeleton from '../../../../Components/Skeleton.vue';
export default {
    components: {
        Skeleton,
        Carousel,
        Slide,
        Slider,
        Pagination,
        Navigation,
        LeftCategoryList,
        // LazyComponent: defineAsyncComponent(() =>
        //     import('./Slider.vue')
        // ),

    },
    methods: {
        load_image: window.load_image,
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                url = "/cache/" + url;
                url.replaceAll('//', '/');
                return url;
            }
        },
    },

    created: function(){
        console.log('banner');
        // console.log(this.home_hero_slider_side_banner);
    },

    computed: {
        ...mapState(use_home_page_store, {
            home_hero_slider_side_banner: 'home_hero_slider_side_banner',
            preloader: 'preloader',
            side_nav_categories: "side_nav_categories",
        }),
    },

};
</script>
