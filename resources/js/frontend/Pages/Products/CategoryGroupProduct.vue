<template>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>
        <section class="category_page_header">
            <!-- <div class="custom-container">
                <h2 class="page_header_title" v-if="category.page_header_title">
                    {{ category.page_header_title }}
                </h2>
                <div class="page_header_description" v-if="category.page_header_description"
                    v-html="category.page_header_description"></div>

                <ul class="page_sub_category_lists">
                    <li v-for="sub in childrens" :key="sub.id">
                        <Link :href="`/category/${sub.slug}`">
                        {{ sub.title }}
                        </Link>
                    </li>
                </ul>
            </div> -->
        </section>
        <section class="section-big-pt-space ratio_asos b-g-light">
            <div class="collection-wrapper">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-sm-3 collection-filter category-page-side">

                            <div
                                class="collection-filter-block filter_varient_group creative-card creative-inner category-side">
                                <div class="collection-mobile-back">
                                    <span class="filter-back">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        back
                                    </span>
                                </div>

                                <PriceRange />

                                <!-- <BrandVarients /> -->

                                <!-- <AllVarients /> -->
                            </div>

                        </div>
                        <div class="collection-content col">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="top-banner-wrapper mb-2">
                                            <img v-if="products?.productOfferDetails"
                                                :src="products?.productOfferDetails?.image" class="img-fluid"
                                                :alt="products?.productOfferDetails?.title">
                                            <img v-else
                                                src="https://files.etek.com.bd/cache/uploads/categories/etek-category.png"
                                                class="img-fluid">
                                            <!-- <div class="top-banner-content small-section">
                                                <h1 class="category_page_heading">
                                                    {{ category.title }}
                                                </h1>
                                            </div> -->
                                        </div>
                                        <div class="top-bar ws-box">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-2 actions">
                                                    <button class="tool-btn" id="lc-toggle">
                                                        <i class="fa fa-filter"></i>
                                                        Filter
                                                    </button>
                                                    <label class="page-heading m-hide">
                                                        <!-- {{ category.title }} -->
                                                    </label>
                                                </div>
                                                <div class="col-sm-8 col-xs-10 show-sort">
                                                    <div class="form-group rs-none">
                                                        <label>Show:</label>
                                                        <div class="custom-select">
                                                            <select id="input-limit">
                                                                <option value="20" selected="selected">20</option>
                                                                <option value="24">24</option>
                                                                <option value="48">48</option>
                                                                <option value="75">75</option>
                                                                <option value="90">90</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sort By:</label>
                                                        <div class="custom-select">
                                                            <select id="input-sort">
                                                                <option value="">Default</option>
                                                                <option value="p.price-ASC">Price (Low &gt; High)
                                                                </option>
                                                                <option value="p.price-DESC">Price (High &gt; Low)
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collection-product-wrapper">

                                            <div class=" py-5">
                                                <div class="product_list"
                                                    :class="{ product_left: products?.data?.data?.length < 5 }">
                                                    <div v-for="i in products?.data?.data" :key="i.name">
                                                        <ProductItem :product="i" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-pagination">
                                                <div class="theme-paggination-block">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination">
                                                                    <li class="page-item"
                                                                        :class="{ active: link.active }"
                                                                        v-for="(link, index) in products?.data?.links"
                                                                        :key="index">
                                                                        <a :href="link.url"
                                                                            @click.prevent="loadProduct(link)"
                                                                            class="page-link text_no_wrap">
                                                                            <span v-html="link.label"></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                                            <!-- <div class="product-search-count-bottom">
                                                                <h5>Showing Products {{
                    products?.data?.from
                }}-{{ search_result?.to }} of {{
                                                                    search_result?.total }}
                                                                    Result</h5>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="card" v-if="category.page_full_description">
                                                <div class="card-body">
                                                    <h3 class="page_full_description_title"
                                                        v-if="category.page_full_description_title">
                                                        {{ category.page_full_description_title }}
                                                    </h3>
                                                    <div class="page_full_description"
                                                        v-html="category.page_full_description"></div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4"></div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import PriceRange from "./CategoryVarients/PriceRange.vue";
import BrandVarients from "./CategoryVarients/BrandVarients.vue";
import AllVarients from "./CategoryVarients/AllVarients.vue";
import ProductItem from "../../Components/ProductItem.vue";
import BreadCumb from '../../Components/BreadCumb.vue';

import { product_store } from "./Store/product_store.js"
import { mapActions, mapState } from 'pinia';



export default {

    components: { Layout, PriceRange, BrandVarients, AllVarients, ProductItem, BreadCumb },

    props: {
        slug: String,
    },
    data: () => ({
        bread_cumb: [
            {
                title: 'offer-products',
                url: '#',
                active: false,
            },
        ],
    }),
    setup(props) {
        const use_product_store = product_store();
        use_product_store.slug = props.slug;


        const loadProduct = async (link) => {
            try {
                let url = new URL(link.url, window.location.origin);
                window.scrollTo({
                    top: 300,
                    behavior: 'smooth'
                });
                await use_product_store.get_all_products_and_single_group_by_category_group_id(url.href);
            } catch (error) {
                console.error('Error loading product:', error);
            }
        };

        return {
            loadProduct,
        };

    },
    created: async function () {
        await this.get_all_products_and_single_group_by_category_group_id();
    },
    methods: {
        ...mapActions(product_store, {
            get_all_products_and_single_group_by_category_group_id: 'get_all_products_and_single_group_by_category_group_id',
        })
    },
    computed: {
        ...mapState(product_store, {
            products: 'products',
        })
    }


};
</script>


<style></style>
