<template>
    <Layout>
        <div class="breadcrumb-main py-3">
            <div class="custom-container">
                <BreadCumb :bread_cumb="bread_cumb" />
            </div>
        </div>

        <section class="login-page section-big-py-space b-g-light">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                        <div class="theme-card">
                            <h3 class="text-center">Login</h3>
                            <form class="theme-form" @submit.prevent="loginFormHandler($event)" method="post">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" />

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" />

                                </div>
                                <button class="btn btn-normal">Login</button>
                                <a class="float-end txt-default mt-2" href="#">
                                    Forgot your password?
                                </a>
                            </form>
                            <p class="mt-3">Sign up for a free account at our store. Registration is quick and easy. It
                                allows you to be able to order from our shop. To start shopping click register.</p>
                            <a href="register.html" class="txt-default pt-3 d-block">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </Layout>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { auth_store } from "../../Store/auth_store.js";
import BreadCumb from "../../Components/BreadCumb.vue";
import Layout from "../../Shared/Layout.vue";
export default {
    components: { Layout, BreadCumb },
    data: () => ({
        bread_cumb: [
            {
                title: 'login',
                url: '/login',
                active: true,
            },
        ],

    }),
    created: async function () {
        await this.check_is_auth();
        if (this.is_auth) {
            window.location.href = "/profile";
        }
    },
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: "check_is_auth",
            user_login: "user_login",
        }),
        loginFormHandler: async function (event) {
            this.user_login(event.target);
        }
    },
    computed: {
        ...mapState(auth_store, {
            is_auth: "is_auth",
        }),
    },
};
</script>

<style></style>
