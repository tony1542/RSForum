<template>
    <div class="flex flex-col justify-between">
        <header class="p-4">
            <slot name="header"></slot>
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
header {
	background-color: var(--grey-lighter);
	margin-bottom: 0;
	border: 1px solid rgba(42, 51, 58, 0.125);
	border-radius: .25em .25em 0 0;
}
main {
	border: 1px solid rgba(42, 51, 58, 0.125);
	border-radius: 0 0 .25em .25em;
	background-color: var(--white);
	padding: 10px 30px 20px 30px;
}
</style>