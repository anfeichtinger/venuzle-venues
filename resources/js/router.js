import { createWebHistory, createRouter } from "vue-router";

import Home from "./components/Home";
import Venues from "./components/Venues";
import AddVenue from "./components/AddVenue";
import EditVenue from "./components/EditVenue";

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
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
