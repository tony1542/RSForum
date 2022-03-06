<template>
    <div class="col-lg-4">
        <Card>
            <template #header>
                Register
            </template>

            <div class="flex flex-col justify-between">
                <form @submit.prevent="register">
                    <div>
                        <label for="username">Username</label>
                        <input
                            id="username"
                            v-model="username"
                            type="text"
                            placeholder="Zezima"
                        >
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input
                            id="email"
                            v-model="email"
                            type="text"
                        >
                    </div>
                    <div>
                        <label for="account-type">Account Type</label>
                        <!-- TODO this is slightly less wide than other inputs; fix this -->
                        <select
                            id="account-type"
                            v-model.number="accountType"
                        >
                            <option
                                v-for="(type, id) in accountTypes"
                                :key="type"
                                :value="id"
                            >
                                {{ type }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input
                            id="password"
                            v-model="password"
                            type="password"
                        >
                    </div>
                    <div>
                        <label for="confirm-password">Confirm Password</label>
                        <input
                            id="confirm-password"
                            v-model="confirmPassword"
                            type="password"
                        >
                    </div>
                    <div>
                        <button class="primary">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </Card>
    </div>
</template>

<script>
    import Card from "./partials/Card";
    import Store from "../store";
    import Request from "../helpers/Request";

    export default {
        name: "Register",
        components: {
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
        created() {
            let request = new Request('AccountType/All');
            request.call()
                .then(data => this.accountTypes = data);
        },
        methods: {
            register: function () {
                let errors = [];

                if (!this.username) {
                    errors.push('Must give a username');
                }

                if (!this.email) {
                    errors.push('Must give an email');
                }

                if (!this.password || !this.confirmPassword) {
                    errors.push('Must give a password and confirm password');
                }

                if (this.confirmPassword !== this.password) {
                    errors.push('Passwords do not match');
                }

                if (errors.length !== 0) {
                    Store.setErrors(errors);

                    return;
                }

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
                            this.$router.push('/');
                        }
                    });
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
        }
    }
</script>

<style scoped>

</style>