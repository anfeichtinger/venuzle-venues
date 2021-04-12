<template>
    <div>
        <navbar />
        <router-view class="lg:m-16 md:m-12 m-4" />
    </div>
</template>

<script lang="ts">
import Navbar from "./widgets/Navbar.vue";
export default {
    name: "App",
    components: {
        Navbar,
    },
};
</script>

<style lang="scss">
@import "../css/buttons.scss";
</style>
