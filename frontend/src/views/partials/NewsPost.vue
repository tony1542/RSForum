<template>
	<div>
		<Card
			class="mb-8"
		>
			<template #header>
				{{ post.title }}
			</template>
			
			<div class="flex align-items-center row">
				<div class="pr-6 col-md-6 col-lg-3">
					<img
						:src="post.enclosure['@attributes'].url"
						alt="Descriptive Image"
						class="img-fluid mb-2"
					>
				</div>
				
				<div class="col-md-6 col-lg-9">
					{{ post.description }}
				</div>
			</div>
			
			<template #footer>
				<a
					:href="post.link"
					target="_blank"
				>
					Read more..
				</a>
			</template>
		</Card>
	</div>
</template>

<script>
import Card from "./Card.vue";

export default {
	name: "NewsPost",
	components: {
		Card
	},
	props: {
		post: {
			type: Object,
			default: () => ({})
		}
	}
}
</script>

<style lang="scss" scoped>
a {
	color: var(--primary);
	text-decoration: none;
	
	&:hover {
		color: var(--primary-dark);
	}
}
</style>