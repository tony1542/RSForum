<template>
	<div class="row row-cols-1 row-cols-md-2 g-4">
		<div class="col"
		     v-for="accolade in accolades"
		     v-bind:key="accolade.accolade_index"
		>
			<Card>
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