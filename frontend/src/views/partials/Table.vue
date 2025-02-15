<template>
	<div>
		<table class="table">
			<thead v-show="$slots.thead">
				<slot name="thead" />
			</thead>
			<tbody v-show="$slots.tbody">
				<slot name="tbody" />
			</tbody>
			<tfoot v-show="$slots.tfoot">
				<slot name="tfoot" />
			</tfoot>
		</table>
	</div>
</template>

<script>
export default {
	name: "Table"
}
</script>

<style scoped>
table {
	color: var(--text-primary-color);
}
</style>