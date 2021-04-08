<template>
    <div>
        <h4>All Bookings</h4>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Venue ID</th>
                    <th>Start At</th>
                    <th>Stop At</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="booking in bookings" :key="booking.id">
                    <td>{{ booking.id }}</td>
                    <td>{{ booking.customer }}</td>
                    <td>{{ booking.venue_id }}</td>
                    <td>{{ booking.bookingTime.split("-")[0] }}</td>
                    <td>{{ booking.bookingTime.split("-")[1] }}</td>
                    <td>{{ booking.updated_at }}</td>
                    <td>
                        <div class="text-right" role="group">
                            <router-link
                                :to="{
                                    name: 'editbooking',
                                    params: { id: booking.id },
                                }"
                                class="btn btn-primary mx-2"
                                >Edit
                            </router-link>
                            <button
                                class="btn btn-danger mx-2"
                                @click="deleteBooking(booking.id)"
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
            @click="this.$router.push('/bookings/add')"
        >
            Add Booking
        </button>
    </div>
</template>

<script lang="ts">
export default {
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
