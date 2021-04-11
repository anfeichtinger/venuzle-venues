<template>
    <div>
        <h4>Add Venue</h4>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="addVenue">
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
                            v-model="venue.open_at"
                        />
                    </div>
                    <div class="form-group">
                        <label>Closes At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="venue.close_at"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Add Venue
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
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
};
</script>
