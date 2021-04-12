<template>
    <div>
        <page-title :title="`Edit booking for ${venue.name}`"></page-title>
        <div
            v-if="errors"
            class="shadow-md bg-red-500 p-2 rounded-md text-white font-bold"
        >
            <p v-for="error in errors" :key="error" class="text-sm text-danger">
                {{ error[0] }}
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 mt-8">
            <form @submit.prevent="updateBooking">
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
                        required
                    />
                </div>
                <button type="submit" class="btn btn-primary">
                    Update Booking
                </button>
            </form>
            <div>
                <label class="input-label"> Opening times </label>
                <p class="mb-4 mt-2">
                    {{ venue.open_at }} - {{ venue.close_at }}
                </p>
                <label class="input-label">
                    Other Bookings for this venue
                </label>
                <table class="shadow-md bg-white w-full mt-2">
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
</template>

<script lang="ts">
import PageTitle from "../widgets/PageTitle.vue";
export default {
    components: { PageTitle },
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
                    .catch((error) => {
                        console.log(error);
                    });
            })
            .catch((error) => {
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
                .catch((error) => {
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
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../css/input.scss";
@import "../../css/table.scss";
</style>
