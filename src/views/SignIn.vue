<template>
    <div>
        <Card>
            <template v-slot:header>
                Sign in
            </template>

            <div>
                <form @submit.prevent="signIn" class="flex flex-col justify-between">
                    <div>
                        <label for="username">Username</label>
                        <input v-model="username" type="text" id="username">
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
    export default {
        name: "SignIn",
        components: {
            Card
        },
        data() {
            return {
                username: '',
                password: ''
            }
        },
        methods: {
            signIn: function () {
	            this.errors = [];

	            if (!this.username) {
		            this.addError('Must give a username');
	            }

	            if (!this.password) {
		            this.addError('Must give password');
	            }

	            let request = new Request('User/SignIn');
	            request.post({
		            'username': this.username,
		            'password': this.password,
	            })
		            .then(data => {
			            if (data.token) {
				            localStorage.setItem('token', data.token);
				            this.store.setJWT(data.token);
				            this.resetForm();
			            }

						// TODO put this in top-level so it doesn't need to be accounted for in each component
			            if (data.errors) {
				            this.errors = data.errors;
			            }
		            });
            },
	        addError(error) {
				this.errors.push(error);
	        },
	        resetForm() {
				this.username = '';
				this.password = '';
	        }
        }
    }
</script>

<style scoped>

</style>