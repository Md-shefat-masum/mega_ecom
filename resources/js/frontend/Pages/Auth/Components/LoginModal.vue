<template>
    <div id="myAccount" class="add_to_cart right account-bar">
        <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
        <div class="cart-inner">
            <div class="cart_top">
                <h3>my account</h3>
                <div class="close-cart">
                    <a href="javascript:void(0)" onclick="closeAccount()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="p-2 alert-danger mx-2 my-4">Please login to perform this action</div>
            <template v-if="is_login">
                <form class="theme-form" @submit.prevent="loginFormHandler($event)" method="post">
                    <label>Enter your Phone</label>
                    <input type="number" name="phone_number" id="phone_number" class="form-control"
                        placeholder="Enter your phone number" />
                    <button class="btn btn-normal my-2" >Login</button>

                    <div class="accout-fwd">

                        <Link href="/register" class="d-block">
                        <h6>you have no account ?<span>signup now</span></h6>
                        </Link>
                    </div>
                </form>
            </template>

            <template v-if="is_otp_verify">
                <div class="theme-card">
                    <h3 class="text-center my-2">Verify otp</h3>
                    <form class="theme-form" @submit.prevent="OtpVerifyFormHandler($event)" method="post">
                        <div class="form-group">
                            <label>Enter your otp</label>
                            <input type="number" name="otp" id="otp" class="form-control">
                        </div>
                        <button class="btn btn-normal">Send</button>
                    </form>
                </div>
            </template>


        </div>
    </div>
</template>

<script>

export default {
    data: () => ({
        is_login: true,
        is_otp_verify: false,
        phone_number: "",
    }),
    methods: {
        loginFormHandler: async function (event) {
            let formData = new FormData(event.target);
            let response = await axios.post('/login', formData)
            if (response.data?.status === "success") {
                window.s_alert(response.data?.message);
                this.is_login = false;
                this.is_otp_verify = true;
                this.phone_number = response.data?.data?.phone_number;
            }
        },

        OtpVerifyFormHandler: async function (event) {
            let formData = new FormData(event.target);
            formData.append("phone_number", this.phone_number);
            let response = await axios.post('/verify-user-otp', formData)
            if (response.data?.status === "success") {
                console.log(response.data);

                localStorage.setItem("token", response.data?.data?.access_token);
                window.s_alert(response.data?.message);
                setTimeout(() => {
                    window.s_alert("You are login successfully");
                    window.location.reload();
                }, 1000)

            }
        },

    }
}
</script>

<style></style>
