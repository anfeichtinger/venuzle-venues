<template>
    <div class="container">
        <h4>Venues</h4>
        <div class="row mt-5">
            <div
                class="col-12 col-sm-6 col-md-4 py-2"
                v-for="venue in venues"
                :key="venue.id"
            >
                <div class="card w-100" style="width: 18rem">
                    <div class="card-body">
                        <h5 class="card-title">{{ venue.name }}</h5>
                        <p class="card-text">
                            Open From: {{ venue.openingTimes.split("-")[0] }}
                            <br />
                            Open To: {{ venue.openingTimes.split("-")[1] }}
                        </p>
                        <a href="#" class="btn btn-primary">Create Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
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
};
</script>
