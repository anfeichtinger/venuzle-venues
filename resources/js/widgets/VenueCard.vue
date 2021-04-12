<template>
    <div class="bg-white p-6 rounded-lg shadow-lg w-auto">
        <h4 class="text-xl font-bold mb-2 text-gray-800">
            {{ venue.name }}
        </h4>
        <p>
            Opens at: {{ venue.open_at }}
            <br />
            Closes at: {{ venue.close_at }}
        </p>
        <button
            type="button"
            @click="createBooking(venue.id)"
            class="btn-primary mt-4"
        >
            Create Booking
        </button>
    </div>
</template>

<script lang="ts">
export default {
    name: "VemueCard",
    props: {
        venue: Object,
    },
    methods: {
        createBooking: function (venue_id) {
            this.$router.push({
                path: "/bookings/add",
                query: { venue: venue_id },
            });
        },
    },
};
</script>
