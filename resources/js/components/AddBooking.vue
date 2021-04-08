<template>
    <div>
        <h4>Add Booking</h4>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="addBooking">
                    <div class="form-group">
                        <label>Customer</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="booking.customer"
                        />
                    </div>
                    <div class="form-group">
                        <label>Start At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="startAt"
                        />
                    </div>
                    <div class="form-group">
                        <label>Stop At</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="stopAt"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Add Booking
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
            booking: {},
            startAt: "00:00",
            stopAt: "24:00",
        };
    },
    created() {
        console.log(this.$route.query.venue);
        this.booking.venue_id = this.$route.query.venue;
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
    },
};
</script>
