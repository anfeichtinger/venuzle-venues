<template>
    <div>
        <h4>All Venues</h4>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Opens At</th>
                    <th>Closes At</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="venue in venues" :key="venue.id">
                    <td>{{ venue.id }}</td>
                    <td>{{ venue.name }}</td>
                    <td>{{ venue.open_at }}</td>
                    <td>{{ venue.close_at }}</td>
                    <td>{{ venue.updated_at }}</td>
                    <td>
                        <div class="text-right" role="group">
                            <router-link
                                :to="{
                                    name: 'editvenue',
                                    params: { id: venue.id },
                                }"
                                class="btn btn-primary mx-2"
                                >Edit
                            </router-link>
                            <button
                                class="btn btn-danger mx-2"
                                @click="deleteVenue(venue.id)"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <button
            type="button"
            class="btn btn-primary"
            @click="this.$router.push('/venues/add')"
        >
            Add Venue
        </button>
    </div>
</template>

<script lang="ts">
export default {
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
    methods: {
        deleteVenue(id) {
            this.$axios
                .delete(`/api/venues/delete/${id}`)
                .then((response) => {
                    let i = this.venues.map((item) => item.id).indexOf(id);
                    this.venues.splice(i, 1);
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
};
</script>
