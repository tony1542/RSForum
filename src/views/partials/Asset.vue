<template>
	<div>
		<img :src="getFilePath()" />
	</div>
</template>

<script>
export default {
	name: "Asset",
	props: {
		path: {
			type: String,
			required: true
		}
	},
	methods: {
		getFilePath: function () {
			return `/src/assets/images/OSRS/${ this.path }.webp`;
		}
	}
}
</script>

<style scoped>

</style>