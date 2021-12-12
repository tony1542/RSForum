<template>
	<div>
		<Card>
			<template v-slot:header>
				Sign in
			</template>

			<div>
				<form @submit.prevent="signIn" class="flex flex-col justify-between">
					<div>
						<label for="email">Email</label>
						<input v-model="email" type="text" id="email">
					</div>
					<div>
						<label for="password">Password</label>
						<input v-model="password" type="password" id="password">
					</div>
					<div>
						<button class="primary">Sign in</button>
					</div>
				</form>
			</div>
		</Card>
	</div>
</template>

<script>
import Card from "./partials/Card";
import Request from "../helpers/Request";
import Store from "../store";

export default {
	name: "SignIn",
	components: {
		Card
	},
	data() {
		return {
			email: '',
			password: ''
		}
	},
	methods: {
		signIn: function () {
			let errors = [];

			if (!this.email) {
				errors.push('Must give an email');
			}

			if (!this.password) {
				errors.push('Must give password');
			}

			if (errors.length !== 0) {
				Store.setErrors(errors);

				return;
			}

			let request = new Request('User/SignIn');
			request.post({
				'email': this.email,
				'password': this.password,
			})
				.then(data => {
					if (data.token) {
						localStorage.setItem('token', data.token);
						Store.setJWT(data.token);
						this.resetForm();
						this.$router.push('/');
					}
				});
		},
		addError(error) {
			this.errors.push(error);
		},
		resetForm() {
			this.email = '';
			this.password = '';
		}
	}
}
</script>

<style scoped>

</style>