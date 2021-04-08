<template>
    <div>
        <h4>Edit Booking</h4>
        <div class="row mt-5">
            <div class="col-md-6">
                <form @submit.prevent="updateBooking">
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
                        Update Booking
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
        this.$axios
            .get(`/api/bookings/edit/${this.$route.params.id}`)
            .then((response) => {
                this.booking = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        updateBooking() {
            this.booking.bookingTime = `${this.startAt}-${this.stopAt}`;
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post(
                        `/api/bookings/update/${this.$route.params.id}`,
                        this.booking
                    )
                    .then((response) => {
                        this.$router.push({ name: "bookings" });
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
};
</script>
