<template>
    <div id="app">
        <Nav/>

        <!-- Render requested component -->
        <div class="flex justify-center align-items-center">
            <div class="content rounded">
	            <Errors :errors="store.errors"/>

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
	import Errors from "./views/partials/Errors";
    import Request from "./helpers/Request";

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
        created() {
			const token = localStorage.getItem('token');

			if (Store.JWT !== token && token !== null) {
				Store.setJWT(token);
			}

			let request = new Request('User/Account');
			request.post()
			.then(data => {
				console.log(data)
			});
        },
	    watch: {
		    $route (to, from) {
				Store.clearErrors();
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
</style>