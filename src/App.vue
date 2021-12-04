<template>
    <div id="app">
        <Nav />

        <!-- Render requested component -->
        <router-view/>
    </div>
</template>

<script>
    import Nav from "./views/partials/Nav";

    export default {
        name: 'App',
        components: {
            Nav
        },
        data() {
            return {

            }
        }
    }
</script>