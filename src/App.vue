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
	import Store from "./store";

    export default {
        name: 'App',
        components: {
            Nav
        },
        data() {
            return {}
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
</style>