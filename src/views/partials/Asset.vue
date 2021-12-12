<template>
	<div>
		<img :src="getFilePath()" :alt="path" :width="width" :height="height" />
	</div>
</template>

<script>
export default {
	name: "Asset",
	props: {
		path: {
			type: String,
			required: true
		},
		height: {
			type: Number,
			default: 30
		},
		width: {
			type: Number,
			default: 30
		},
		fileType: {
			type: String,
			default: 'webp'
		}
	},
	methods: {
		getFilePath: function () {
			return `/src/assets/images/OSRS/${ this.path }.${ this.fileType }`;
		}
	}
}
</script>

<style scoped>

</style>