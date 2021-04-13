<template>
    <div>
        <page-title title="Add Venues"></page-title>
        <notice :msgs="errors" :error="true"></notice>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
            <form @submit.prevent="addVenue">
                <div class="input-container">
                    <label class="input-label">Name</label>
                    <input
                        type="text"
                        class="input-text"
                        v-model="venue.name"
                        placeholder="Sport Union"
                        autofocus
                        required
                    />
                </div>
                <div class="input-container">
                    <label class="input-label">Opens At</label>
                    <input
                        type="time"
                        class="input-text"
                        v-model="venue.open_at"
                        placeholder="08:00"
                        required
                    />
                </div>
                <div class="input-container">
                    <label class="input-label">Closes At</label>
                    <input
                        type="time"
                        class="input-text"
                        v-model="venue.close_at"
                        placeholder="15:00"
                        required
                    />
                </div>
                <button type="submit" class="btn-primary mt-4">
                    Add Venue
                </button>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
import Notice from "../widgets/Notice.vue";
import PageTitle from "../widgets/PageTitle.vue";
export default {
    components: { PageTitle, Notice },
    data() {
        return {
            venue: {},
            errors: {},
        };
    },
    created() {
        this.venue.open_at = "06:00";
        this.venue.close_at = "22:00";
    },
    methods: {
        addVenue() {
            this.$axios
                .post("/api/venues/add", this.venue)
                .then((response) => {
                    this.$router.push({ name: "venues" });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../css/input.scss";
</style>
