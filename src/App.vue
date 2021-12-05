<template>
    <div id="app">
        <Nav/>

        <!-- Render requested component -->
        <div class="flex justify-center align-items-center">
            <div class="content rounded">
                <router-view />
            </div>
        </div>
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
            return {}
        },
        // created() {
        //     // TODO have this in an environment var somewhere
        //     // TODO or a main network class that has it as a property
        //     fetch('http://localhost:9001', {
        //         mode: 'cors'
        //     })
        //         .then(response => response.json())
        //         .then(data => console.log(data));
        // }
    }
</script>

<style>
    @import "src/assets/scss/styles.scss";

    .content {
        padding: 1rem;
        background-color: var(--grey-lightest);
        margin-top: 90px;
        width: 75%;
    }
</style>