
import { defineStore } from "pinia";

export const blog_store = defineStore("blog_store", {

    state: () => ({
        is_auth: 0,
        blog_data: {},
        single_blog_data: {},
        role: {},
    }),

    getters: {},
    actions: {

        get_all_blogs: async function () {
            let response = await axios.get("/get-all-blogs");
            if (response.data.status == 'success') {
                this.blog_data = response.data.data;
            }
        },
        get_single_blog: async function (slug) {
            let response = await axios.get(`/get-single-blog/${slug}`);
            if (response.data.status == 'success') {
                this.single_blog_data = response.data.data;
            }
        },


    },
});
