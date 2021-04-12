<template>
    <div>
        <page-title title="All Bookings"></page-title>
        <table class="shadow-md bg-white w-full">
            <thead>
                <tr>
                    <th class="table-cell">ID</th>
                    <th class="table-cell">Customer</th>
                    <th class="table-cell">Venue ID</th>
                    <th class="table-cell">Begin At</th>
                    <th class="table-cell">End At</th>
                    <th class="table-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="booking in bookings" :key="booking.id">
                    <td class="table-cell">{{ booking.id }}</td>
                    <td class="table-cell">{{ booking.customer }}</td>
                    <td class="table-cell">{{ booking.venue_id }}</td>
                    <td class="table-cell">{{ booking.booking_begin }}</td>
                    <td class="table-cell">{{ booking.booking_end }}</td>
                    <td class="table-cell">
                        <router-link
                            :to="{
                                name: 'editbooking',
                                params: { id: booking.id },
                            }"
                            class="btn-primary mx-2"
                            >Edit
                        </router-link>
                        <button
                            class="btn-danger mx-2"
                            @click="deleteBooking(booking.id)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
export default {
    components: { PageTitle },
    data() {
        return {
            bookings: [],
        };
    },
    created() {
        this.$axios
            .get("/api/bookings")
            .then((response) => {
                this.bookings = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        deleteBooking(id) {
            this.$axios
                .delete(`/api/bookings/delete/${id}`)
                .then((response) => {
                    let i = this.bookings.map((item) => item.id).indexOf(id);
                    this.bookings.splice(i, 1);
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
