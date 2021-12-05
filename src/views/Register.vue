<template>
	<div>
		<Errors :errors="errors"/>

		<Card>
			<template v-slot:header>
				Sign in
			</template>

			<div class="flex flex-col justify-between">
				<form @submit.prevent="register">
					<div>
						<label for="username">Username</label>
						<input v-model="username" type="text" id="username">
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
import Request from "../helpers/Request";

export default {
	name: "Register",
	components: {
		Errors,
		Card
	},
	data() {
		return {
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
		// TODO backend validation & how to handle the response
		register: function () {
			this.errors = [];

			if (!this.username) {
				this.addError('Must give a username');
			}

			// TODO check for email format too
			if (!this.email) {
				this.addError('Must give an email');
			}

			if (!this.accountType) {
				this.addError('Must specify account type');
			}

			if (!this.password || !this.confirmPassword) {
				this.addError('Must give a password and confirm password');
			}

			if (this.confirmPassword !== this.password) {
				this.addError('Passwords do not match');
			}
		},
		addError: function (error) {
			if (this.errors.includes(error)) {
				return;
			}

			this.errors.push(error);
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