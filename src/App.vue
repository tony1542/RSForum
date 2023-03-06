<template>
    <div>
        <Nav />

        <!-- Render requested component -->
        <div>
            <div class="container flex flex-col justify-center align-items-center mb-8 mt-8">
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
    import Nav from "./views/partials/Nav.vue";
    import Store from "./store";
    import LoadingSpinner from "./views/partials/LoadingSpinner.vue";
    import Errors from "./views/partials/Errors.vue";

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
</style>