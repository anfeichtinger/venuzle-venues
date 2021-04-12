<template>
    <div>
        <page-title title="Edit Venues"></page-title>
        <div
            v-if="errors"
            class="shadow-md bg-red-500 p-2 rounded-md text-white font-bold"
        >
            <p v-for="error in errors" :key="error" class="text-sm text-danger">
                {{ error[0] }}
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <form @submit.prevent="updateVenue">
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
                        type="text"
                        class="input-text"
                        v-model="venue.open_at"
                        placeholder="08:00"
                        required
                    />
                </div>
                <div class="input-container">
                    <label class="input-label">Closes At</label>
                    <input
                        type="text"
                        class="input-text"
                        v-model="venue.close_at"
                        placeholder="15:00"
                        required
                    />
                </div>
                <button type="submit" class="btn-primary mt-4">
                    Update Venue
                </button>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
export default {
    components: { PageTitle },
    data() {
        return {
            venue: {},
            errors: null,
        };
    },
    created() {
        this.$axios
            .get(`/api/venues/edit/${this.$route.params.id}`)
            .then((response) => {
                this.venue = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        updateVenue() {
            this.$axios
                .post(`/api/venues/update/${this.$route.params.id}`, this.venue)
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
