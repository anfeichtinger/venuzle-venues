<template>
    <div>
        <page-title :title="`Add booking for ${venue.name}`"></page-title>
        <notice :msgs="errors" :error="true"></notice>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 mt-8">
            <form @submit.prevent="addBooking">
                <div class="input-container">
                    <label class="input-label">Customer</label>
                    <input
                        type="text"
                        class="input-text"
                        v-model="booking.customer"
                        placeholder="John Doe"
                        autofocus
                        required
                    />
                </div>
                <div class="input-container">
                    <label class="input-label">Begin At</label>
                    <input
                        type="text"
                        class="input-text"
                        v-model="booking.booking_begin"
                        placeholder="08:00"
                        v-mask="'##:##'"
                        required
                    />
                </div>
                <div class="input-container">
                    <label class="input-label">End At</label>
                    <input
                        type="text"
                        class="input-text"
                        v-model="booking.booking_end"
                        placeholder="15:00"
                        v-mask="'##:##'"
                        required
                    />
                </div>
                <button type="submit" class="btn-primary mt-4">
                    Add Booking
                </button>
            </form>
            <div>
                <label class="input-label"> Opening times </label>
                <p class="mb-4 mt-2">
                    {{ venue.open_at }} - {{ venue.close_at }}
                </p>
                <label class="input-label">
                    Other bookings for this venue
                </label>
                <spinner v-if="loading"></spinner>
                <div v-else>
                    <p v-if="otherBookings.length == 0">No other bookings...</p>
                    <table v-else class="shadow-md bg-white w-full mt-2">
                        <thead>
                            <tr>
                                <th class="table-cell">Customer</th>
                                <th class="table-cell">Booking Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="otherBooking in otherBookings"
                                :key="otherBooking.id"
                            >
                                <td class="table-cell">
                                    {{ otherBooking.customer }}
                                </td>
                                <td class="table-cell">
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
import { mask } from "vue-the-mask";
import Notice from "../widgets/Notice.vue";
import PageTitle from "../widgets/PageTitle.vue";
import Spinner from "../widgets/Spinner.vue";
export default {
    components: { PageTitle, Notice, Spinner },
    data() {
        return {
            booking: {},
            venue: {},
            otherBookings: [],
            errors: {},
            loading: true,
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
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    directives: { mask },
};
</script>

<style lang="scss" scoped>
@import "../../css/input.scss";
@import "../../css/table.scss";
</style>
