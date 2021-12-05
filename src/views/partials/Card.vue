<template>
    <div class="flex flex-col justify-between">
        <header>
            <slot name="header"></slot>
            <hr v-show="$slots.header">
        </header>

        <main>
            <slot></slot>
        </main>

        <footer>
            <hr v-show="$slots.footer">
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
main {
    padding: 10px 30px 20px 30px;
    background-color: var(--white);
    border: 1px solid rgba(42, 51, 58, 0.125);
    border-radius: .25rem;
}
</style>