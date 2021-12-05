<template>
    <div id="app">
        <Nav/>

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
            return {}
        },
        created() {
            // TODO have this in an environment var somewhere
            // TODO or a main network class that has it as a property
            fetch('http://localhost:9001', {
                mode: 'cors'
            })
                .then(response => response.json())
                .then(data => console.log(data));
        }
    }
</script>