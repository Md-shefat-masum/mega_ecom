<template>
    <div class="modal_category_left_side_show">
        <ul class="category_list">
            <li class="category_modal_close" @click="close_category">
                <i class="fa fa-close"></i>
            </li>
            <li v-for="category in top_categories" :key="category.id">
                <Link :href="`/category/${category.slug}`">
                <img :src="`/${category.image}`" :alt="category.title">
                <span class="link_title">
                    {{ category.title }}
                </span>
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data: () => ({
        top_categories: [],
    }),
    created: function () {
        setTimeout(() => {
            this.get_categories();
        }, 500);
    },
    methods: {
        get_categories: async function () {
            let res = await axios.get('/nav-categories');
            let data = res.data;
            this.top_categories = data;
        },
        close_category: function () {
            document.querySelector('.modal_category_left_side_show').classList.toggle('modal_category');
            document.querySelector('.modal_category_left_side_show').classList.toggle('active');
        }
    }
}
</script>
<style lang="">

</style>
