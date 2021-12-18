<template>
    <div class="card flex flex-col">
        <header v-show="this.$slots.header" class="card-header">
            <slot name="header"></slot>
        </header>

        <main class="card-body">
            <slot></slot>
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
}
footer {
	background-color: var(--grey-lighter);
	margin-bottom: 0;
	border: 1px solid rgba(42, 51, 58, 0.125);
	border-radius:0 0 .25em .25em;
}
</style>