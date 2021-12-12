<template>
	<div class="flex flex-wrap">
		<Card
			class="p-4 w-48"
			v-for="skill in skills"
			v-bind:key="skill.skill_index"
		>
			<template v-slot:header>
				<div class="flex justify-between">
					<span>
						<Asset :path="`Skills/${ skill.skill_name }`" fileType="png" />
					</span>
					<span>
						{{ skill.skill_name }}
					</span>
				</div>
			</template>
			<div>
				XP {{ skill.exp }}
			</div>
			<template v-slot:footer>
				<div class="flex justify-between">
					<div>
						<span v-if="skill.level">
							Level {{ skill.level }}
						</span>
					</div>
					<div>
						Rank {{ skill.rank }}
					</div>
				</div>
			</template>
		</Card>
	</div>
</template>

<script>
import Card from "../Card";
import Asset from "../Asset";
export default {
	name: "Skills",
	components: {Asset, Card},
	props: {
		skills: Array
	}
}
</script>

<style scoped>

</style>