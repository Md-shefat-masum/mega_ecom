<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>cart</h2>
                                <ul>
                                    <li><a href="javascript:void(0)">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="cart-section section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">action</th>
                                    <th scope="col">total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <template v-if="all_cart_data.length > 0">
                                    <tr v-for="cart in all_cart_data" :key="cart.id">
                                        <td>
                                            <Link :href="`/product-details/${cart?.product?.slug}`"><img
                                                :src="`/${cart.product.product_image.url}`" alt="cart" class=" "></Link>
                                        </td>
                                        <td>
                                            <Link :href="`/product-details/${cart?.product?.slug}`">{{
                                    cart.product.title }}
                                            </Link>
                                            <div class="mobile-cart-content">
                                                <div class="col-xs-3">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input type="number" name="quantity"
                                                                class="form-control input-number"
                                                                v-model="cart.quantity" @keyup="
                                    cart_quantity_update(
                                        cart.id,
                                        null,
                                        $event.target.value
                                    )
                                    ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h2 class="td-color">${{ cart.product.current_price }}</h2>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h2 class="td-color">
                                                        <Link :href="`/product-details/${cart?.product?.slug}`"
                                                            class="icon"><i class="ti-close"></i></Link>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2>${{ cart.product.current_price }}</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="quantity"
                                                        class="form-control input-number" v-model="cart.quantity"
                                                        @keyup="
                                    cart_quantity_update(
                                        cart.id,
                                        null,
                                        $event.target.value
                                    )
                                    ">
                                                </div>
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0)" @click="remove_cart_item(cart.id)"
                                                class="icon"><i class="ti-close"></i></a></td>
                                        <td>
                                            <h2 class="td-color">${{ cart.quantity * cart.product.current_price }}</h2>
                                        </td>
                                    </tr>
                                </template>

                                <template v-else>
                                    <tr>
                                        <td colspan="6">
                                            <h2 class="td-color text-center">No item found in cart</h2>
                                        </td>
                                    </tr>
                                </template>

                            </tbody>

                        </table>
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                                <tr>
                                    <td>total price :</td>
                                    <td>
                                        <h2>${{ total_cart_price }}</h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row cart-buttons">
                    <div class="col-12">
                        <Link href="/" class="btn btn-normal">continue shopping</Link>
                        <Link v-if="all_cart_data.length > 0" href="/checkout" class="btn btn-normal ms-3">check out</Link>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { auth_store } from "../../Store/auth_store";
export default {
    components: { Layout },

    created: async function () {
        await this.check_is_auth();
        if (!this.is_auth) {
            this.$inertia.visit("/login");
        }
    },
    methods: {
        ...mapActions(common_store, {
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
        }),
        ...mapActions(auth_store, {
            "check_is_auth": "check_is_auth",
        }),
    },

    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
        }),
        ...mapState(auth_store, {
            "is_auth": "is_auth",
        }),
    },
};
</script>

<style></style>
