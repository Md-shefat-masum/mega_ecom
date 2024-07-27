<template>
    <template v-if="product.product_images.length > 0">
        <a :href="check_image_url(product.product_images[0].url)" data-lightbox="prouct-set"
            :data-title="`Additional image`">
            <img :src="imageUrl" alt="" class="img-fluid image_zoom_cls-0" />
        </a>
        <ul>
            <li v-for="(image, index) in product.product_images.reverse()" :key="image.id">
                <a :href="check_image_url(image.url)" data-lightbox="prouct-set"
                    :data-title="`Additional image ${index + 1}`">
                    <img height="150" width="150" class="border p-1 mx-1  c-pointer"
                        @click="imageUrl = check_image_url(image.url)" :src="`/${image.url}`" alt="" />
                </a>
            </li>
        </ul>
    </template>
</template>

<script>
export default {
    props: ["product"],
    data: () => ({
        imageUrl: '',
    }),
    created() {
        this.imageUrl = this.check_image_url(this.product.product_images[0].url);
    },
    watch: {
        product: {
            handler: function(v){
                this.imageUrl = this.check_image_url(this.product.product_images[0].url);
            },
            deep: true,

        }
    },
    methods: {
        check_image_url: function (url) {
            try {
                new URL(url);
                return url;
            } catch (e) {
                return "/" + url;
            }
        },
    }
}
</script>

<style></style>
