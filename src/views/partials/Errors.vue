<template>
    <!-- TODO finish -->
    <div v-show="errors.length > 0">
        <span v-for="(error, id) in errors" v-bind:key="id">
            {{ error }}
        </span>
    </div>
</template>

<script>
    export default {
        name: "Errors",
        props: {
            errors: {
                type: Array
            }
        }
    }
</script>

<style scoped lang="scss">
    span {
        background-color: var(--red-lightest);
        border: 1px solid var(--red-light);
    }

    span {
    }
</style>