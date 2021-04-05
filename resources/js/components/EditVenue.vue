<template>
    <div>
        <h4>Edit Venue</h4>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="updateVenue">
                    <div class="form-group">
                        <label>Name</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="venue.name"
                        />
                    </div>
                    <div class="form-group">
                        <label>Opens At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="opensAt"
                        />
                    </div>
                    <div class="form-group">
                        <label>Closes At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="closesAt"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update Venue
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    data() {
        return {
            venue: {},
            opensAt: "00:00",
            closesAt: "24:00",
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get(`/api/venues/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.venue = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    },
    methods: {
        updateVenue() {
            this.venue.openingTimes = `${this.opensAt}-${this.closesAt}`;
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post(
                        `/api/venues/update/${this.$route.params.id}`,
                        this.venue
                    )
                    .then((response) => {
                        this.$router.push({ name: "venues" });
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
};
</script>
