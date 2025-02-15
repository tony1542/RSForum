<template>
	<div>
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<router-link
					class="navbar-brand"
					exact
					to="/"
				>
					Home
				</router-link>
				
				<button
					aria-controls="navbarNav"
					aria-expanded="false"
					aria-label="Toggle navigation"
					class="navbar-toggler"
					data-bs-target="#navbarNav"
					data-bs-toggle="collapse"
					type="button"
				>
					<span class="navbar-toggler-icon"/>
				</button>
				
				<div
					id="navbarNav"
					class="collapse navbar-collapse"
				>
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<router-link
								class="nav-link"
								to="/About"
							>
								About
							</router-link>
						</li>
						<li class="nav-item">
							<router-link
								v-if="store.isUserSignedIn()"
								class="nav-link"
								to="/account"
							>
								Account
							</router-link>
						</li>
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item">
                            <span
	                            class="nav-link cursor-pointer"
	                            @click="showSettings = true"
                            >
                                Settings
                            </span>
						</li>
						<li
							v-show="store.isUserSignedIn()"
							class="nav-item"
							@click="logout"
						>
							<span class="nav-link cursor-pointer">Logout</span>
						</li>
						<li
							v-show="!store.isUserSignedIn()"
							class="nav-item"
						>
							<router-link
								class="nav-link"
								to="/SignIn"
							>
								Sign-in
							</router-link>
						</li>
						<li
							v-show="!store.isUserSignedIn()"
							class="nav-item"
						>
							<router-link
								class="nav-link"
								to="/Register"
							>
								Register
							</router-link>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<Modal
			:show="showSettings"
			@close="showSettings = false"
		>
			<template #header>
				Settings
			</template>
			<template #body>
				<Settings/>
			</template>
		</Modal>
	</div>
</template>

<script>
import Store from "../../store";
import Settings from "../Settings.vue";
import Modal from "./Modal.vue";

export default {
	name: "Nav",
	components: {
		Settings,
		Modal
	},
	data() {
		return {
			store: Store,
			showSettings: false
		}
	},
	methods: {
		logout() {
			localStorage.clear();
			this.store.clearJWTAndData();
			this.$router.push({
				path: '/'
			});
		}
	}
}
</script>

<style scoped>
.nav {
	position: fixed;
	width: 100%;
	top: 0;
	left: 0;
	padding-top: 1rem;
	padding-bottom: 1rem;
	background-color: var(--darkBackground);
}

/* https://router.vuejs.org/api/#active-class */
.router-link-active {
	color: var(--primary) !important;
}
</style>