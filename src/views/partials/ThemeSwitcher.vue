<template>
    <span @click="toggleTheme">
        <span v-if="userTheme === 'dark-theme'">
            <FontAwesomeIcon icon="fa-solid fa-sun" />
        </span>
        <span v-else>
            <FontAwesomeIcon icon="fa-solid fa-moon" />
        </span>
    </span>
</template>

<script>
    export default {
        name: "ThemeSwitcher",
        data() {
            return {
                userTheme: "light-theme",
            };
        },
        mounted() {
            const initUserTheme = this.getMediaPreference();
            this.setTheme(initUserTheme);
        },
        methods: {
            toggleTheme() {
                const activeTheme = localStorage.getItem("user-theme");
                if (activeTheme === "light-theme") {
                    this.setTheme("dark-theme");
                } else {
                    this.setTheme("light-theme");
                }
            },
            setTheme(theme) {
                localStorage.setItem("user-theme", theme);
                this.userTheme = theme;
                document.documentElement.className = theme;
            },
            getMediaPreference() {
                const activeTheme = localStorage.getItem("user-theme");
                if (activeTheme) {
                    return activeTheme;
                }
				
                const hasDarkPreference = window.matchMedia(
                    "(prefers-color-scheme: dark)"
                ).matches;
                if (hasDarkPreference) {
                    return "dark-theme";
                } else {
                    return "light-theme";
                }
            },
        },
    };
</script>

<style scoped>

</style>
