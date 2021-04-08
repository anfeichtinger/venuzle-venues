import { createWebHistory, createRouter } from "vue-router";

import Home from "./components/Home";
import Venues from "./components/Venues";
import AddVenue from "./components/AddVenue";
import EditVenue from "./components/EditVenue";
import Bookings from "./components/Bookings";
import AddBooking from "./components/AddBooking";
import EditBooking from "./components/EditBooking";

export const routes = [
    {
        name: "home",
        path: "/",
        component: Home,
    },
    {
        name: "venues",
        path: "/venues",
        component: Venues,
    },
    {
        name: "addvenue",
        path: "/venues/add",
        component: AddVenue,
    },
    {
        name: "editvenue",
        path: "/venues/edit/:id",
        component: EditVenue,
    },
    {
        name: "bookings",
        path: "/bookings",
        component: Bookings,
    },
    {
        name: "addbooking",
        path: "/bookings/add",
        component: AddBooking,
    },
    {
        name: "editbooking",
        path: "/bookings/edit/:id",
        component: EditBooking,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
