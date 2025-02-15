<template>
	<Table>
		<template #thead>
			<tr>
				<th>Skill</th>
				<th>Experience</th>
				<th>Level</th>
				<th>Rank</th>
			</tr>
		</template>
		<template #tbody>
			<tr
				v-for="skill in skills"
				:key="skill.skill_index"
			>
				<td>
					<div class="flex">
						<Asset
							:path="`Skills/${ skill.skill_name }`"
							file-type="png"
						/>
						<div class="pl-3">{{ skill.skill_name}}</div>
					</div>
				</td>
				<td>{{ skill.exp }}</td>
				<td>{{ skill.level }}</td>
				<td>{{ skill.rank }}</td>
			</tr>
		</template>
	</Table>
</template>

<script>
import Asset from "../Asset.vue";
import Table from "../Table.vue";

export default {
	name: "SkillTable",
	components: {Table, Asset},
	props: {
		skills: Array,
	}
}
</script>

<style scoped>

</style>