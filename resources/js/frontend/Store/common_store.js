import { defineStore } from "pinia";
import axios from "axios";
export const common_store = defineStore("common_store", {
    state: () => ({
        all_cart_data: [],
        all_wish_list_data: [],
        all_compare_list_data: [],
        total_cart_price: 0,
        api_prefix: "api/v1",
    }),

    actions: {
        //cart
        //cart
        get_all_cart_data: async function () {
            let token = localStorage.getItem('token');
            if (token) {
                this.total_cart_price = 0;
                let response = await window.privateAxios(`/get-cart-items?get_all=1`);
                if (response.status == "success") {
                    this.all_cart_data = response.data;
                    if (this.all_cart_data) {
                        let itemTotal = this.all_cart_data.map(
                            (item) => item.quantity * item.product?.current_price
                        );
                        itemTotal.forEach((item2) => {
                            this.total_cart_price = this.total_cart_price + item2;
                        });
                    }
                }
            }
        },

        add_to_cart: async function (productId) {
            console.log(productId);
            const response = await window.privateAxios(`/add-to-cart`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response?.status === "success") {
                window.s_alert(response.message);
                this.get_all_cart_data();
            }

        },

        cart_quantity_update: async function (cartId, action, quantity) {
            const response = await axios.post(
                `/update-cart-item-quantity`,
                {
                    cartId,
                    action,
                    quantity,
                }
            );

            if (response.data.status === "success") {
                window.s_alert(response.data.message);
                this.get_all_cart_data();
            }
            if (response.data.status === "warning") {
                window.w_alert(response.data.message);
            }
        },

        remove_cart_item: async function (cartId) {
            var data = await window.s_confirm();
            if (data) {
                let response = await axios.delete(
                    `/remove-cart-item/${cartId}`
                );
                if (response.data.status == "success") {
                    window.s_alert(response.data.message);
                    this.get_all_cart_data();
                }
            }
        },

        //wishlist
        //wishlist
        get_all_wish_list_items: async function () {
            this.total_cart_price = 0;
            let response = await window.privateAxios(`/get-wish-list-items?get_all=1`);
            if (response.status == "success") {
                this.all_wish_list_data = response.data;
            }
        },
        add_to_wish_list: async function (productId) {
            const response = await window.privateAxios(`/add-to-wish-list`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response.status === "success") {
                window.s_alert(response.message);
            }

            if (response.status === "warning") {
                window.w_alert(response.message);
            }
        },
        remove_wish_list_item: async function (id) {
            var data = await window.s_confirm();
            if (data) {
                let response = await window.privateAxios(`/remove-wish-list-item/${id}`, 'delete');
                if (response.status == "success") {
                    window.s_alert(response.message);
                    this.get_all_wish_list_items();
                }
            }
        },

        //comparelist
        //comparelist
        get_all_compare_list_items: async function () {
            let response = await window.privateAxios(`/get-compare-list-items?get_all=1`);
            if (response.status == "success") {
                this.all_compare_list_data = response.data;
            }
        },
        add_to_compare_list: async function (productId) {
            const response = await window.privateAxios(`/add-to-compare-list`, 'post',
                {
                    product_id: productId,
                }
            );

            if (response.status === "success") {
                window.s_alert(response.data.message);
            }

            if (response.status === "warning") {
                window.w_alert(response.data.message);
            }
        },
        remove_compare_list_item: async function (id) {
            var data = await window.s_confirm();
            if (data) {
                let response = await window.privateAxios(`/remove-compare-list-item/${id}`, 'delete');
                if (response.status == "success") {
                    window.s_alert(response.message);
                    this.get_all_compare_list_items();
                }
            }
        },
    },
});
