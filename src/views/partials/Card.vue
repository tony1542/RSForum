<template>
    <div class="card">
        <header v-show="this.$slots.header" class="card-header">
            <slot name="header"></slot>
        </header>

        <main class="card-body">
            <slot class="card-text"></slot>
        </main>

        <footer v-show="this.$slots.footer" class="card-footer">
            <slot name="footer"></slot>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "Card"
    }
</script>

<style scoped>
</style>