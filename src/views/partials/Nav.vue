<template>
    <div>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link
                    class="navbar-brand"
                    to="/"
                    exact
                >
                    Home
                </router-link>
				
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon" />
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
                            <router-link
                                to="/"
                                class="nav-link"
                            >
                                Logout
                            </router-link>
                        </li>
                        <li
                            v-show="!store.isUserSignedIn()"
                            class="nav-item"
                        >
                            <router-link
                                to="/SignIn"
                                class="nav-link"
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
                <Settings />
            </template>
        </Modal>
    </div>
</template>

<script>
    import Store from "../../store";
    import Settings from "../Settings";
    import Modal from "./Modal";
	
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

.links {
    padding: 0.5rem 1rem;
}

a {
    font-weight: 500;
    color: var(--grey);
    margin: 0 5px;
    text-decoration: none;
}

a:hover {
    color: var(--grey-lightest);
}

/* https://router.vuejs.org/api/#active-class */
.router-link-active {
    color: var(--primary) !important;
}
</style>