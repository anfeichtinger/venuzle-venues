<template>
    <div>
        <page-title title="Available Venues"></page-title>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-12 lg:gap-16"
        >
            <venue-card
                v-for="venue in venues"
                :key="venue.id"
                :venue="venue"
            ></venue-card>
        </div>
    </div>
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
import VenueCard from "../widgets/VenueCard.vue";
export default {
    name: "Home",
    data() {
        return {
            venues: [],
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get("/api/venues")
                .then((response) => {
                    this.venues = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    },
    components: {
        PageTitle,
        VenueCard,
    },
};
</script>
