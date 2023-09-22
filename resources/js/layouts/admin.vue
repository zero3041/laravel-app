<template>
    <TheHeader />
    <SiderBar />

    <router-view></router-view>

    <TheFooter />
</template>
<script>
import TheHeader from '../components/TheHeader.vue'
import TheFooter from '../components/TheFooter.vue'
import SiderBar from '../components/SiderBar.vue'
import content_header from '../components/content_header.vue'
export default {
    components: {
        TheHeader,
        TheFooter,
        SiderBar,
        content_header
    },
    setup() {
    }
}
</script>
