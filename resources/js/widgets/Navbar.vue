<template>
    <header
        class="lg:px-16 px-6 bg-white flex flex-wrap items-center lg:py-0 py-2 shadow-md mb-8"
    >
        <div class="flex-1 flex justify-between items-center text-xl">
            <router-link to="/">Venuzle<strong>Venues</strong></router-link>
        </div>

        <label for="menu-toggle" class="pointer-cursor lg:hidden block"
            ><svg
                class="fill-current text-gray-900"
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 20 20"
            >
                <title>menu</title>
                <path
                    d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                ></path></svg
        ></label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul
                    class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0"
                >
                    <li>
                        <router-link to="/venues" class="nav-link"
                            >All Venues</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            to="/bookings"
                            class="nav-link lg:mb-0 mb-2"
                            >All Bookings</router-link
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script lang="ts">
export default {
    name: "Navbar",
};
</script>

<style lang="scss" scoped>
#menu-toggle:checked + #menu {
    display: block;
}

.nav-link {
    @apply lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-green-400;
}
</style>
