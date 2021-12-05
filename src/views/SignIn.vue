<template>
    <div>
        <Card>
            <template v-slot:header>
                Sign in
            </template>

            <div>
                <form class="flex flex-col justify-between">
                    <div>
                        <label for="username">Username</label>
                        <input v-model="username" type="text" id="username">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input v-model="password" type="password" id="password">
                    </div>
                    <div>
                        <button @click="signIn" class="primary">Sign in</button>
                    </div>
                </form>
            </div>
        </Card>
    </div>
</template>

<script>
    import Card from "./partials/Card";
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
                // TODO implement
            }
        }
    }
</script>

<style scoped>

</style>