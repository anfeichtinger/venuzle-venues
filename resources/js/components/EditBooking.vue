<template>
    <div>
        <h4>Edit Booking for {{ this.venue.name }}</h4>
        <div v-if="errors" class="shadow-md">
            <p v-for="error in errors" :key="error" class="text-sm text-danger">
                {{ error[0] }}
            </p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="updateBooking">
                    <div class="form-group">
                        <label>Customer</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="this.booking.customer"
                            required
                            autofocus
                        />
                    </div>
                    <div class="form-group">
                        <label>Begin At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="this.booking.booking_begin"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>End At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="this.booking.booking_end"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update Booking
                    </button>
                </form>
            </div>
            <div class="cols-md-6 mt-2">
                <h5>Other Bookings for this venue</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Booking Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="otherBooking in otherBookings"
                                :key="otherBooking.id"
                            >
                                <td>{{ otherBooking.customer }}</td>
                                <td>
                                    {{ otherBooking.booking_begin }} -
                                    {{ otherBooking.booking_end }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    data() {
        return {
            booking: {},
            venue: {},
            otherBookings: [],
            errors: null,
        };
    },
    created() {
        this.$axios
            .get(`/api/bookings/edit/${this.$route.params.id}`)
            .then((response) => {
                this.booking = response.data;
                this.$axios
                    .get(`/api/venues/${this.booking.venue_id}`)
                    .then((response) => {
                        this.venue = response.data;
                        this.getOtherBookings();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    methods: {
        updateBooking() {
            this.booking.bookingTime = `${this.startAt}-${this.stopAt}`;
            this.$axios
                .post(
                    `/api/bookings/update/${this.$route.params.id}`,
                    this.booking
                )
                .then((response) => {
                    this.$router.push({ name: "bookings" });
                })
                .catch(function (error) {
                    this.errors = error.response.data.errors;
                });
        },
        getOtherBookings() {
            this.$axios
                .get(`/api/bookings/venue/${this.booking.venue_id}`)
                .then((response) => {
                    this.otherBookings = response.data;
                    const delID = this.booking.id;

                    this.otherBookings.splice(
                        this.otherBookings.findIndex(function (i) {
                            return i.id === delID;
                        }),
                        1
                    );
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
};
</script>
