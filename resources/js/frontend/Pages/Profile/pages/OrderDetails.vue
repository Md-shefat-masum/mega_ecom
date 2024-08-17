<template>
    <ProfileLayout :bread_cumb="bread_cumb">

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="http://127.0.0.1:8000/frontend/images/etek_logo.png"
                                        style="width: 100%; max-width: 150px" />
                                </td>

                                <td>
                                    Invoice #: <span class="fw-bold"> {{ order_info.order_id }}</span><br />
                                    Date : {{ new Date(order_info.created_at).toDateString() }}<br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td style="width: 50%">
                        <h4>Delivery Information</h4><br>
                        {{ order_info.order_delivery_address?.address }}.<br />
                        {{ order_info.order_delivery_address?.station?.name }} ,
                        {{ order_info.order_delivery_address?.district?.name }}, {{
        order_info.order_delivery_address?.division?.name }} <br><br>
                    </td>

                    <td>
                        <h4>User Information</h4><br>
                        {{ order_info.user?.name }}.<br />
                        {{ order_info.user?.email }}<br />
                        {{ order_info.user?.phone_number }}
                    </td>
                </tr>

                <tr class="heading ">
                    <td>Item</td>

                    <td>Price</td>
                </tr>

                <tr class="item" v-for="item in order_info.order_products" :key="item.id">
                    <td>{{ item.product?.title }}</td>

                    <td>{{ item.product?.current_price }}</td>
                </tr>
                <tr class="total">
                    <td></td>

                    <td>Total: {{ order_info.total }}</td>
                </tr>
            </table>
        </div>
        <div class="text-center">
            <button id="printBtn" @click="printInvoice" class="btn btn-info mt-3 fw-bold text-white w-50 py-2">Print
                Invoice</button>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "../shared/ProfileLayout.vue";
export default {
    components: { ProfileLayout },
    props: {
        order_id: String,
    },
    data: () => ({
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: false,
            },
            {
                title: 'orders',
                url: '/profile/orders',
                active: true,
            },
        ],
        order_info: {}
    }),
    created: async function () {
        await this.get_single_order_details();
    },
    methods: {
        get_single_order_details: async function () {
            let response = await window.privateAxios('/get-single-order-details/' + this.order_id);
            this.order_info = response.data;


        },
        printInvoice() {
            window.print();
        }
    },

};
</script>
<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.invoice-box.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.invoice-box.rtl table {
    text-align: right;
}

.invoice-box.rtl table tr td:nth-child(2) {
    text-align: left;
}

@media print {
    header {
        display: none;
    }

    footer {
        display: none;
    }

    .account-sidebar {
        display: none;
    }

    .breadcrumb {
        display: none;
    }

    .category_modal_toggler {
        display: none;
    }

    #printBtn {
        display: none;
    }

    .card {
        border: none !important;
    }

    .invoice-box {
        border: none !important;
        box-shadow: none !important;
    }

    .cart_total {
        display: none;
    }
}
</style>
