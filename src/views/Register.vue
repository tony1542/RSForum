<template>
    <div>
        <Errors :errors="errors" />

        <Card>
            <template v-slot:header>
                Sign in
            </template>

            <div class="form flex flex-col justify-between">
                <div>
                    <label for="username">Username</label>
                    <input v-model="username" type="text" id="username">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input v-model="email" type="text" id="email">
                </div>
                <div>
                    <!-- TODO select list of account types here; maybe from a simple js cache file? or get from API backend /shrug -->
                    <label for="account-type">Account Type</label>
                    <input v-model="accountType" type="text" id="account-type">
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
                    <button @click="register" class="primary">Register</button>
                </div>
            </div>
        </Card>
    </div>
</template>

<script>
    import Card from "./partials/Card";
    import Errors from "./partials/Errors";

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
                password: '',
                confirmPassword: '',
                errors: [
                    'test'
                ]
            }
        },
        methods: {
            register: function () {
                // this.errors = [];

                if (this.confirmPassword !== this.password) {
                    this.errors.push('Passwords do not match');
                }
            }
        }
    }
</script>

<style scoped>

</style>