<template>
    <div>
        <h4>Add Booking for {{ this.venue.name }}</h4>
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
                        <label>Start At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="startAt"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Stop At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="stopAt"
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
                                <td>{{ otherBooking.bookingTime }}</td>
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
            startAt: "00:00",
            stopAt: "24:00",
        };
    },
    created() {
        this.booking.venue_id = this.$route.query.venue || 1;
        this.$axios
            .get(`/api/venues/${this.booking.venue_id}`)
            .then((response) => {
                this.venue = response.data;
                this.getOtherBookings();
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        addBooking() {
            this.booking.bookingTime = `${this.startAt}-${this.stopAt}`;
            this.$axios
                .post("/api/bookings/add", this.booking)
                .then((response) => {
                    this.$router.push({ name: "bookings" });
                })
                .catch(function (error) {
                    console.error(error);
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
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
};
</script>
