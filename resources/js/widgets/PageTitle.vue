<template>
    <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ title }}</h2>
</template>

<script lang="ts">
export default {
    name: "PageTitle",
    props: {
        title: String,
    },
};
</script>
