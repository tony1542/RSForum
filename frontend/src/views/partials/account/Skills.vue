<template>
	<div class="row row-cols-1 row-cols-md-2 g-4">
		<div
			v-for="skill in skills"
			:key="skill.skill_index"
			class="col"
		>
			<Card>
				<template #header>
					<div class="flex justify-between">
                        <span>
                            <Asset
	                            :path="`Skills/${ skill.skill_name }`"
	                            file-type="png"
                            />
                        </span>
						<span>
                            {{ skill.skill_name }}
                        </span>
					</div>
				</template>
				<div>
					XP {{ skill.exp }}
				</div>
				<template #footer>
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
	</div>
</template>

<script>
import Card from "../Card.vue";
import Asset from "../Asset.vue";

export default {
	name: "Skills",
	components: {
		Asset,
		Card
	},
	props: {
		skills: {
			type: Array,
			default: () => []
		}
	}
}
</script>

<style scoped>

</style>