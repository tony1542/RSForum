<template>
    <div id="app">
        <Nav />

        <!-- Render requested component -->
        <div class="flex justify-center align-items-center">
            <div class="content rounded">
                <Errors :errors="store.errors" />

                <div
                    v-show="store.waitingOnAjax"
                    class="flex flex-col items-center"
                >
                    <h2>Loading..</h2>
                    <LoadingSpinner />
                </div>
	            
                <router-view v-show="!store.waitingOnAjax" />
            </div>
        </div>
    </div>
</template>

<script>
    import Nav from "./views/partials/Nav";
    import Store from "./store";
    import LoadingSpinner from "./views/partials/LoadingSpinner";
    import Errors from "./views/partials/Errors";

    export default {
        name: 'App',
        components: {
            LoadingSpinner,
            Nav,
            Errors
        },
        data() {
            return {
                store: Store
            }
        },
        watch: {
            $route (to, from) {
                Store.clearErrors();
            }
        },
        created() {
            const token = localStorage.getItem('token');

            if (Store.JWT !== token && token !== null) {
                Store.setJWT(token);
            }
        }
    }
</script>

<style>
	/* Include our custom styles */
    @import "src/assets/scss/styles.scss";

    .content {
        padding: 1rem;
        width: 75%;
    }
</style>