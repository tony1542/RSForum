<template>
    <div>
        <!-- TODO investigate having a PHP back-end running in a docker instance and this running separately -->

        <h1>{{ text }}</h1>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {
                text: 'Hello world'
            }
        }
    }
</script>

<style scoped>

</style>