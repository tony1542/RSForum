<template>
    <div>
        <div
            class="flex flex-col justify-between"
        >
            <div>
                <div class="mb-3 form-check">
                    <input
                        :id="lightTheme"
                        v-model="userTheme"
                        type="radio"
                        class="form-check-input"
                        name="theme"
                        value="light-theme"
                        @change="toggleTheme"
                    >
                    <label
                        class="form-check-label"
                        :for="lightTheme"
                    >
                        Light Theme
                    </label>
                </div>
                <div class="mb-3 form-check">
                    <input
                        :id="darkTheme"
                        v-model="userTheme"
                        type="radio"
                        class="form-check-input"
                        name="theme"
                        value="dark-theme"
                        @change="toggleTheme"
                    >
                    <label
                        class="form-check-label"
                        :for="darkTheme"
                    >
                        Dark Theme
                    </label>
                </div>
                <div class="mb-3 form-check">
                    <input
                        :id="defaultTheme"
                        v-model="userTheme"
                        type="radio"
                        class="form-check-input"
                        name="theme"
                        value="device-default-theme"
                        @change="setDeviceDefaultTheme"
                    >
                    <label
                        class="form-check-label"
                        :for="defaultTheme"
                    >
                        Device Default
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Card from "./partials/Card";
	
    export default {
        name: "Settings",
        data() {
            return {
                userTheme: 'device-default-theme',
                userThemeKey: 'user-theme',
                lightTheme: 'light-theme',
                darkTheme: 'dark-theme',
                defaultTheme: 'device-default-theme'
            }
        },
        created() {
            const preference = this.getMediaPreference();
	
            if (preference === this.defaultTheme) {
                document.documentElement.className = this.getDeviceDefault();
            } else {
                this.setTheme(
                    preference
                );
            }
        },
        methods: {
            toggleTheme() {
                this.setTheme(this.userTheme);
            },
            setDeviceDefaultTheme() {
                this.setTheme(
                    this.getDeviceDefault()
                );
				
                const theme = this.defaultTheme;
                localStorage.setItem(this.userThemeKey, theme);
                this.userTheme = theme;
            },
            setTheme(theme) {
                localStorage.setItem(this.userThemeKey, theme);
                this.userTheme = theme;
                document.documentElement.className = theme;
            },
            getMediaPreference() {
                const activeTheme = localStorage.getItem(
                    this.userThemeKey
                );
                if (activeTheme) {
                    return activeTheme;
                }

                return this.getDeviceDefault();
            },
            getDeviceDefault() {
                const hasDarkPreference = window.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches;
				
                if (hasDarkPreference) {
                    return this.darkTheme;
                }

                return this.lightTheme;
            }
        },
    }
</script>

<style scoped>

</style>