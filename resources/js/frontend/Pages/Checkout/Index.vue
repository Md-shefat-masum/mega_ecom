<template>
    <Layout>
        <div class="breadcrumb-main ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-contain">
                            <div>
                                <h2>checkout</h2>
                                <ul>
                                    <li><a href="/">home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i></li>
                                    <li><a href="javascript:void(0)">checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="checkout-page contact-page">
                    <div class="checkout-form">
                        <form @submit.prevent="checkoutFormSubmit($event)">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="theme-form">
                                        <div class="row check-out ">
                                            <div class="checkout-title text-center">
                                                <h3>Billing Details</h3>

                                                <hr>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-16 col-xs-12">
                                                <input type="hidden" name="address_id"
                                                    :value="user_info.user_delivery_address?.id" id="">
                                                <label>User full Name</label>
                                                <input type="text" name="user_name" id="user_name"
                                                    :value="`${user_info.name} ${user_info.user_name}`" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="field-label">Phone</label>
                                                <input type="text" name="phone" id="phone"
                                                    :value="user_info.phone_number" placeholder="">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="field-label">Email Address</label>
                                                <input type="text" name="email" id="email" :value="user_info.email"
                                                    placeholder="">
                                            </div>
                                            <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="field-label">Country</label>
                                                <select name="country">
                                                    <option>India</option>
                                                    <option>South Africa</option>
                                                    <option>United State</option>
                                                    <option>Australia</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="field-label">Address</label>
                                                <input type="text" name="address" id="address"
                                                    :value="user_info.user_delivery_address?.address"
                                                    placeholder="Street address">
                                            </div>
                                            <div class="form-group required">
                                                <label for="state_division_id">Division</label>
                                                <select name="state_division_id" id="state_division_id"
                                                    class="form-control" v-model="state_division_id">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(division, index) in divisions" :key="index"
                                                        :value="division.id"
                                                        :selected="division.id == user_address_info?.state_division_id ? 'selected' : ''">
                                                        {{
                            division.name }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <label for="district_id">District</label>
                                                <select name="district_id" id="district_id" class="form-control"
                                                    v-model="district_id" :disabled="isSelectDistrictDisabled">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(district, index) in districts" :key="index"
                                                        :value="district.id" :selected="false">{{ district.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group required">
                                                <label for="station_id">Station</label>
                                                <select name="station_id" id="station_id" class="form-control"
                                                    v-model="station_id" :disabled="isSelectStationDisabled">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option v-for="(station, index) in stations" :key="index"
                                                        :value="station.id" :selected="false">{{ station.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="checkbox" name="shipping-option" id="account-option">
                                                <label for="account-option">Create An Account?</label>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="checkout-details theme-form  ">
                                        <div class="order-box">
                                            <div class="checkout-title text-center">
                                                <h3>Order Details</h3>
                                                <hr>
                                            </div>
                                            <table class="table cart-table table-responsive-xs">
                                                <thead>
                                                    <tr class="table-head">
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr v-for="cart in all_cart_data" :key="cart.id">

                                                        <td width="250px">
                                                            <Link :href="`/product-details/${cart?.product?.slug}`">{{
                            cart.product.title }}
                                                            </Link>
                                                        </td>
                                                        <td>
                                                            <p>{{ get_price(cart?.product).new_price }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ cart.quantity }}</p>
                                                        </td>

                                                        <td>
                                                            <p class="td-color">{{ cart.quantity *
                            get_price(cart?.product).new_price }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <h5>Subtotal</h5>
                                                        </td>

                                                        <td>
                                                            <h5>${{ total_cart_price }}</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td colspan="3">
                                                            <h5>
                                                                Shipping
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="shipping">
                                                                <div class="shopping-option">
                                                                    <input type="checkbox" name="free-shipping"
                                                                        id="free-shipping">
                                                                    <label for="free-shipping">Free Shipping</label>
                                                                </div>
                                                                <div class="shopping-option">
                                                                    <input type="checkbox" name="local-pickup"
                                                                        id="local-pickup">
                                                                    <label for="local-pickup">Local Pickup</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <td colspan="3">
                                                            <h5>Grand Total</h5>
                                                        </td>

                                                        <td>
                                                            <h5>${{ total_cart_price }}</h5>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <div class="payment-box">
                                            <div class="upper-box">
                                                <div class="payment-options">
                                                    <ul>

                                                        <li>
                                                            <div class="radio-option">
                                                                <input type="radio" name="payment_type" id="payment-2"
                                                                    checked="checked" value="cod">
                                                                <label for="payment-2">Cash On Delivery<span
                                                                        class="small-text">Please send a check to Store
                                                                        Name, Store Street, Store Town, Store State /
                                                                        County, Store Postcode.</span></label>
                                                            </div>
                                                        </li>
                                                        <!-- <li>
                                                            <div class="radio-option">
                                                                <input type="radio" value="check_payment"
                                                                    name="payment_type" id="payment-1">
                                                                <label for="payment-1">Check Payments<span
                                                                        class="small-text">Please send a check to Store
                                                                        Name, Store Street, Store Town, Store State /
                                                                        County, Store Postcode.</span></label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="radio-option paypal">
                                                                <input type="radio" value="paypal" name="payment_type"
                                                                    id="payment-3">
                                                                <label for="payment-3">PayPal</label>
                                                            </div>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn-normal btn">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "../../Shared/Layout.vue";
import { mapActions, mapState } from "pinia";
import { common_store } from "../../Store/common_store";
import { auth_store } from "../../Store/auth_store.js";
import { computed, ref } from "vue"
export default {
    components: { Layout },
    data: () => ({


        isSelectDistrictDisabled: true,
        isSelectStationDisabled: true,

        divisions: null,
        districts: null,
        stations: null,

        state_division_id: '',
        district_id: '',
        station_id: '',


    }),

    setup() {
        const authStore = auth_store();
        const user_info = computed(() => authStore.auth_info);


        return { user_info };
    },

    created: async function () {
        const authStore = auth_store();
        await authStore.check_is_auth();
        if (!authStore.is_auth) {
            this.$inertia.visit('/login');
        } else {
            await this.all_division();
            this.user_address_info = authStore.auth_info?.user_delivery_address
            this.state_division_id = this.user_address_info?.state_division_id
            this.district_id = this.user_address_info?.district_id
            this.station_id = this.user_address_info?.station_id
        }
    },


    methods: {

        ...mapActions(common_store, {
            remove_cart_item: "remove_cart_item",
            cart_quantity_update: "cart_quantity_update",
        }),

        checkoutFormSubmit: async function ($event) {
            let formData = new FormData($event.target);
            let response = await window.privateAxios('/customer-ecommerce-order-placed', 'post', formData);

            if (response.status === "success") {
                window.s_alert(response.message);
                this.$inertia.visit('/profile/orders');
            }

        },

        all_division: async function () {
            let response = await axios.get('/state-divisions', {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name'],
                    get_all: 1,
                }
            })
            if (response.data.status === 'success') {
                this.divisions = response.data.data
            }
        },
        get_district_by_state_division_id: async function (state_division_id) {
            let response = await axios.get(`/get-district-by-division-id/${state_division_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.districts = response.data.data
                this.isSelectDistrictDisabled = false;
            }

        },
        get_station_by_district_id: async function (district_id) {
            let response = await axios.get(`/get-station-by-district-id/${district_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.stations = response.data.data
                this.isSelectStationDisabled = false;
            }

        }

    },

    watch: {
        state_division_id: function (divisionId) {
            this.get_district_by_state_division_id(divisionId);
        },
        district_id: function (districtId) {
            this.get_station_by_district_id(districtId);
        }
    },


    computed: {
        ...mapState(common_store, {
            all_cart_data: "all_cart_data",
            total_cart_price: "total_cart_price",
            get_price: "get_price",
        }),
    },
};
</script>

<style></style>
