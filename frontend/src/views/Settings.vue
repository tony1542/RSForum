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
						class="form-check-input"
						name="theme"
						type="radio"
						value="light-theme"
						@change="toggleTheme"
					>
					<label
						:for="lightTheme"
						class="form-check-label"
					>
						Light Theme
					</label>
				</div>
				<div class="mb-3 form-check">
					<input
						:id="darkTheme"
						v-model="userTheme"
						class="form-check-input"
						name="theme"
						type="radio"
						value="dark-theme"
						@change="toggleTheme"
					>
					<label
						:for="darkTheme"
						class="form-check-label"
					>
						Dark Theme
					</label>
				</div>
				<div class="mb-3 form-check">
					<input
						:id="defaultTheme"
						v-model="userTheme"
						class="form-check-input"
						name="theme"
						type="radio"
						value="device-default-theme"
						@change="setDeviceDefaultTheme"
					>
					<label
						:for="defaultTheme"
						class="form-check-label"
					>
						Device Default
					</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
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
	mounted() {
		const preference = this.getMediaPreference();
		const activeTheme = localStorage.getItem(
			this.userThemeKey
		);
		
		if (preference === this.defaultTheme || !activeTheme) {
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