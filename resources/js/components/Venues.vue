<template>
    <div>
        <page-title title="All Venues"></page-title>
        <table class="shadow-md bg-white w-full">
            <thead>
                <tr>
                    <th class="table-cell">ID</th>
                    <th class="table-cell">Name</th>
                    <th class="table-cell">Opens At</th>
                    <th class="table-cell">Closes At</th>
                    <th class="table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="venue in venues" :key="venue.id">
                    <td class="table-cell">{{ venue.id }}</td>
                    <td class="table-cell">{{ venue.name }}</td>
                    <td class="table-cell">{{ venue.open_at }}</td>
                    <td class="table-cell">{{ venue.close_at }}</td>
                    <td class="table-cell">
                        <router-link
                            :to="{
                                name: 'editvenue',
                                params: { id: venue.id },
                            }"
                            class="btn-primary mr-2"
                            >Edit
                        </router-link>
                        <button
                            class="btn-danger"
                            @click="deleteVenue(venue.id)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button
            type="button"
            class="btn-primary mt-8"
            @click="$router.push('/venues/add')"
        >
            Add Venue
        </button>
    </div>
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
export default {
    components: { PageTitle },
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

<style lang="scss" scoped>
@import "../../css/table.scss";
</style>
