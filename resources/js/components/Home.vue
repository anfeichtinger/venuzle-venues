<template>
    <div>
        <page-title title="Available Venues"></page-title>
        <spinner v-if="loading"></spinner>
        <div
            v-else
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-12 lg:gap-16"
        >
            <p v-if="venues.length == 0">No venues yet...</p>
            <venue-card
                v-else
                v-for="venue in venues"
                :key="venue.id"
                :venue="venue"
            ></venue-card>
        </div>
    </div>
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
import Spinner from "../widgets/Spinner.vue";
import VenueCard from "../widgets/VenueCard.vue";
export default {
    name: "Home",
    data() {
        return {
            venues: [],
            loading: true,
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get("/api/venues")
                .then((response) => {
                    this.venues = response.data;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    },
    components: {
        PageTitle,
        VenueCard,
        Spinner,
    },
};
</script>
