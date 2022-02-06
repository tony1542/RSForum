<template>
    <div class="card">
        <header
            v-show="$slots.header"
            class="card-header"
        >
            <slot name="header" />
        </header>

        <main class="card-body">
            <slot class="card-text" />
        </main>

        <footer
            v-show="$slots.footer"
            class="card-footer"
        >
            <slot name="footer" />
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