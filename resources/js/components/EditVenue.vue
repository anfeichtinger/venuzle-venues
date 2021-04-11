<template>
    <div>
        <h4>Edit Venue</h4>
        <div v-if="errors" class="shadow-md">
            <p v-for="error in errors" :key="error" class="text-sm text-danger">
                {{ error[0] }}
            </p>
        </div>
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
