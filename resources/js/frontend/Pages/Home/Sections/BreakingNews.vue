<template>
    <section class="color_bg_banner pb-4 pt-1">
        <div class="custom-container">
            <div class="marquee_body" @mouseover="is_paused = true" @mouseleave="is_paused = false">
                <marquee-text :paused="is_paused" :duration="60">
                    {{ get_setting_value('breaking_news') }}
                </marquee-text>
            </div>
        </div>
    </section>
</template>

<script>
import MarqueeText from 'vue-marquee-text-component'
import { common_store } from "../../../Store/common_store";
import { mapState } from "pinia";
export default {
    components: {
        MarqueeText
    },
    data: () => ({
        is_paused: false,
    }),
    computed: {
        ...mapState(common_store, {
            get_setting_value: "get_setting_value",
        }),
    },
}
</script>

<style></style>
