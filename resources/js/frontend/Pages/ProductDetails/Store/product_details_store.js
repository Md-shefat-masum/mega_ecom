import axios from "axios";
import { defineStore } from "pinia";

export const useProductDetailsStore = defineStore("useProductDetailsStore", {
    state: () => ({
        slug: '',
        product_initial_data: {},
        product_details: {},
        top_products: [],
        related_porducts: [],

        product_question_and_answers: [],

        rating: '',
        review: '',
        imageFiles: [],
        imagePreviews: [],


        fields: [
            "id",
            "title",
            "short_description",
            "customer_sales_price",
            "discount_type",
            "discount_amount",
            "product_brand_id",
            "sku",

        ]

    }),
    getters: {},
    actions: {
        /**
        ## Product information
        ## start
        **/
        get_single_product_initial_data: async function () {
            const fieldsQuery = this.fields.map(field => `fields[]=${field}`).join('&');
            let response = await axios.get(`/get-product-details/${this.slug}?initial=true&${fieldsQuery}`)
            if (response.data.status === "success") {
                this.product_initial_data = response.data.data
            }
            // console.log(this.product_details);
        },
        get_single_product_details: async function () {
            let response = await axios.get('/get-product-details/' + this.slug)
            if (response.data.status === "success") {
                this.product_details = response.data.data
            }
            // console.log(this.product_details);
        },

        get_top_products: async function () {
            let response = await axios.get('/featured-products');
            this.top_products = response.data;
            // console.log(this.top_products);
        },

        /**
        ## Product information
        ## end
        **/

        /**
       ## Review section
       ## start
       */

        async submitReview() {
            const formData = new FormData();
            formData.append('rating', this.rating);
            formData.append('review', this.review);
            formData.append('slug', this.slug);
            this.imageFiles.forEach((file, index) => {
                formData.append(`review_images[${index}]`, file);
            });
            try {
                const response = await window.privateAxios('/submit-product-review', 'post', formData);

                if (response.status === "success") {
                    window.s_alert(response.message);
                    this.rating = 0;
                    this.review = '';
                    this.imageFiles = [];
                    this.imagePreviews = [];
                }


            } catch (error) {
                console.error('There was an error!', error);
            }
        },
        setRating(rating) {
            this.rating = rating;
        },
        addImageFile(file) {
            this.imageFiles.push(file);
        },
        addImagePreview(preview) {
            this.imagePreviews.push(preview);
        },
        removeImageFile(index) {
            this.imageFiles.splice(index, 1);
        },
        setReview(review) {
            this.review = review;
        },
        /**
        ## Review section
        ## end
        */
        set_slug: function(data){
            this.slug = data;
        }
    }
});
