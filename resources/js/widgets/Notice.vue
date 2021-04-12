<template>
    <div
        v-if="Object.keys(msgs).length !== 0"
        class="shadow-md p-2 rounded-md text-white font-bold mb-8"
        :class="error ? 'bg-red-500' : 'bg-green-500'"
    >
        <p v-for="msg in msgs" :key="msg" class="text-sm">
            {{ msg[0] }}
        </p>
    </div>
</template>

<script lang="ts">
export default {
    name: "Notice",
    props: {
        msgs: { type: Object, default: {} },
        error: { type: Boolean, default: false },
    },
};
</script>
