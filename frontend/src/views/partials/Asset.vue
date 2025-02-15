<template>
	<div>
		<img
			:alt="path"
			:height="height"
			:src="getFilePath()"
			:width="width"
		>
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
			return `src/assets/images/OSRS/${this.path}.${this.fileType}`;
		}
	}
}
</script>

<style scoped>

</style>