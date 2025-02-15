<template>
	<div>
		<Card class="mb-8">
			<p>
				This application allows you to connect to a game's (Old School Runescape) high scores and view various
				information about an account.
			</p>
			To accomplish this:
			<ol>
				<li>Create an account under the 'register' menu option <em>("Settled" can be a username if you don't know
					one)</em></li>
				<li>Click the 'Profile' menu option to see relevant stats</li>
			</ol>
		</Card>
	</div>
</template>

<script>
import Card from "./partials/Card.vue";

export default {
	name: "About",
	components: {
		Card
	},
}
</script>