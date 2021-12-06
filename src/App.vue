<template>
    <div id="app">
        <Nav/>

        <!-- Render requested component -->
        <div class="flex justify-center align-items-center">
            <div class="content rounded">
	            <div class="flex flex-col items-center" v-show="store.waitingOnAjax">
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

    export default {
        name: 'App',
        components: {
	        LoadingSpinner,
            Nav
        },
        data() {
            return {
				store: Store
            }
        },
        created() {
			const token = localStorage.getItem('token');
			if (Store.JWT !== token) {
				Store.setJWT(token);
			}
        }
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

    .loader {

    }
</style>