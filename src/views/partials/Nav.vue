<template>
    <div class="nav">
        <router-link to="/">Home</router-link>
        <router-link to="/about">About</router-link>
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
    padding: 1.5rem;
    background-color: var(--darkBackground);
}

a {
    font-weight: 500;
    color: var(--textColor);
    margin: 0 5px;
    text-decoration: none;
}
</style>