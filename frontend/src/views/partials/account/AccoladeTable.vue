<template>
	<Table>
		<template #thead>
			<tr>
				<th>Accolade</th>
				<th>Score</th>
				<th>Rank</th>
			</tr>
		</template>
		<template #tbody>
			<tr
				v-for="accolade in accolades"
				:key="accolade.accolade_index"
			>
				
				{{accolade}}
				
				<td>
					<div class="flex">
						<Asset
							:path="`Accolades/${ accolade.accolade_name }`"
							file-type="webp"
						/>
						<div class="pl-3">{{ accolade.accolade_name }}</div>
					</div>
				</td>
				<td>{{ accolade.score }}</td>
				<td>{{ accolade.rank }}</td>
			</tr>
		</template>
	</Table>
</template>

<script>
import Asset from "../Asset.vue";
import Table from "../Table.vue";

export default {
	name: "AccoladeTable",
	components: {Table, Asset},
	props: {
		accolades: Array,
	}
}
</script>

<style scoped>

</style>