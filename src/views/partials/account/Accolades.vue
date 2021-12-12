<template>
	<div>
		<ul>
			<li v-for="accolade in accolades" v-bind:key="accolade.accolade_index">
				{{ accolade }}
				<Asset :path="`Accolades/${ accolade.accolade_name }`" />
			</li>
		</ul>
	</div>
</template>

<script>
import Asset from "../Asset";
export default {
	name: "Accolades",
	components: {Asset},
	props: {
		accolades: Array
	}
}
</script>

<style scoped>

</style>