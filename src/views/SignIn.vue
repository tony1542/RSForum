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
                        <input type="text" id="username">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="text" id="password">
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
    export default {
        name: "SignIn",
        components: {
            Card
        }
    }
</script>

<style scoped>

</style>