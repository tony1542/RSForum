<template>
    <div class="card">
        <div
            v-show="$slots.header"
            class="card-header"
        >
            <slot name="header" />
        </div>

        <div class="card-body">
            <slot class="card-text" />
        </div>

        <div
            v-show="$slots.footer"
            class="card-footer"
        >
            <slot name="footer" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card"
    }
</script>

<style scoped>
</style>