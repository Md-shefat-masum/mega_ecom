<template>
    <section class="color_bg_banner pb-4 pt-1">
        <div class="custom-container">
            <div class="marquee_body" @mouseover="is_paused = true" @mouseleave="is_paused = false">
                <marquee-text :paused="is_paused">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                    eirmod tempor invidunt ut labore et dolore magna.
                </marquee-text>
            </div>
        </div>
    </section>
</template>

<script>
import MarqueeText from 'vue-marquee-text-component'
export default {
    components: {
        MarqueeText
    },
    data: () => ({
        is_paused: false,
    })
}
</script>

<style>

</style>
