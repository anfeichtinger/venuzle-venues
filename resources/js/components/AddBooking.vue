<template>
    <div>
        <h4>Add Booking for {{ this.venue.name }}</h4>
        <div v-if="errors" class="shadow-md">
            <p v-for="error in errors" :key="error" class="text-sm text-danger">
                {{ error[0] }}
            </p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="addBooking">
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
                        Add Booking
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
        this.booking.venue_id = this.$route.query.venue || 1;
        this.$axios
            .get(`/api/venues/${this.booking.venue_id}`)
            .then((response) => {
                this.venue = response.data;

                this.booking.booking_begin = this.venue.open_at;
                this.booking.booking_end = this.venue.close_at;

                this.getOtherBookings();
            })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        addBooking() {
            this.$axios
                .post("/api/bookings/add", this.booking)
                .then((response) => {
                    this.$router.push({ name: "bookings" });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        selectVenue(venueID) {
            this.booking.venue_id = venueID;
        },
        getOtherBookings() {
            this.$axios
                .get(`/api/bookings/venue/${this.booking.venue_id}`)
                .then((response) => {
                    this.otherBookings = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
