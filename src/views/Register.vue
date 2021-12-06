<template>
	<div>
		<Errors :errors="errors"/>

		<Card>
			<template v-slot:header>
				Register
			</template>

			<div class="flex flex-col justify-between">
				<form @submit.prevent="register">
					<div>
						<label for="username">Username</label>
						<input v-model="username" type="text" id="username" placeholder="Zezima">
					</div>
					<div>
						<label for="email">Email</label>
						<input v-model="email" type="text" id="email">
					</div>
					<div>
						<label for="account-type">Account Type</label>
						<select id="account-type" v-model.number="accountType">
							<option v-for="(type, id) in accountTypes" :key="type" :value="id">
								{{ type }}
							</option>
						</select>
					</div>
					<div>
						<label for="password">Password</label>
						<input v-model="password" type="password" id="password">
					</div>
					<div>
						<label for="confirm-password">Confirm Password</label>
						<input v-model="confirmPassword" type="password" id="confirm-password">
					</div>
					<div>
						<button class="primary">Register</button>
					</div>
				</form>
			</div>
		</Card>
	</div>
</template>

<script>
import Card from "./partials/Card";
import Errors from "./partials/Errors";
import Store from "../store";
import Request from "../helpers/Request";

export default {
	name: "Register",
	components: {
		Errors,
		Card
	},
	data() {
		return {
			store: Store,
			username: '',
			email: '',
			accountType: 0,
			accountTypes: [],
			password: '',
			confirmPassword: '',
			errors: []
		}
	},
	methods: {
		register: function () {
			this.errors = [];

			if (!this.username) {
				this.addError('Must give a username');
			}

			if (!this.email) {
				this.addError('Must give an email');
			}

			if (!this.password || !this.confirmPassword) {
				this.addError('Must give a password and confirm password');
			}

			if (this.confirmPassword !== this.password) {
				this.addError('Passwords do not match');
			}

			if (this.errors.length === 0) {
				let request = new Request('User/Register');
				request.post({
					'username': this.username,
					'email': this.email,
					'accountType': this.accountType,
					'password': this.password,
				})
					.then(data => {
						if (data.token) {
							localStorage.setItem('token', data.token);
							this.store.setJWT(data.token);
							this.resetForm();
						}

						if (data.errors) {
							this.errors = data.errors;
						}
					});
			}
		},
		addError: function (error) {
			if (this.errors.includes(error)) {
				return;
			}

			this.errors.push(error);
		},
		resetForm: function () {
			this.username = '';
			this.email = '';
			this.accountType = 0;
			this.password = '';
			this.confirmPassword = '';
			this.errors = [];
		}
	},
	created() {
		let request = new Request('AccountType/All');
		request.call()
			.then(data => this.accountTypes = data);
	}
}
</script>

<style scoped>

</style>