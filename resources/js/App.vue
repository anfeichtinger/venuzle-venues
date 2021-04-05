<template>
    <div class="container">
        <nav
            class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 bg-white rounded"
        >
            <router-link to="/" class="nav-item nav-link">
                <span class="navbar-brand"
                    >Venuzle<strong>Venues</strong></span
                ></router-link
            >
            <div class="navbar-nav">
                <router-link to="/venues" class="nav-item nav-link"
                    >Edit Venues</router-link
                >
            </div>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-link">GitHub</a>
            </div>
        </nav>
        <router-view />
    </div>
</template>

<script lang="ts">
export default {
    name: "App",
};
</script>
