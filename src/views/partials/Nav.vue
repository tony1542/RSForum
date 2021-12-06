<template>
    <div class="nav flex justify-between items-center">
        <div class="links">
            <router-link to="/" exact>Home</router-link>
            <router-link to="/about">About</router-link>
        </div>
        <div class="links">
            <router-link to="/SignIn">Sign-in</router-link>
            <router-link to="/Register">Register</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Nav"
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

.router-link-active {
    color: var(--primary);
}
</style>