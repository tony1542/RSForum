<template>
	<div class="flex flex-wrap">
		<Card
			class="p-4 w-48"
			v-for="accolade in accolades"
			v-bind:key="accolade.accolade_index"
		>
			<template v-slot:header>
				{{ accolade.accolade_name }}
			</template>
			<Asset :path="`Accolades/${ accolade.accolade_name }`" />
			<template v-slot:footer>
				<div class="flex justify-between">
					<div>
						#{{ accolade.score }}
					</div>
					<div>
						Rank {{ accolade.rank }}
					</div>
				</div>
			</template>
		</Card>
	</div>
</template>

<script>
import Asset from "../Asset";
import Card from "../Card";
export default {
	name: "Accolades",
	components: {Card, Asset},
	props: {
		accolades: Array
	}
}
</script>

<style scoped>

</style>