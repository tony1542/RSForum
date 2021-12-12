<template>
	<div class="flex justify-between">
		<Card>
			<template v-slot:header>
				{{ username }}
			</template>
			{{ accountTypeText }}
			<!-- TODO allow account type switching or something here -->
		</Card>
		<Card>
			<Accolades :accolades="accolades" />
			<Skills :skills="skills" />
		</Card>
	</div>
</template>

<script>
import Request from "../helpers/Request";
import Accolades from "./partials/account/Accolades";
import Skills from "./partials/account/Skills";
import Card from "./partials/Card";

export default {
	name: "Account",
	components: {
		Card,
		Skills,
		Accolades
	},
	data() {
		return {
			username: '',
			accountTypeId: '',
			accountTypeText: '',
			skills: [],
			accolades: []
		}
	},
	created() {
		let request = new Request('User/Account');
		request.post()
			.then(data => {
				this.username = data.username;
				this.accountTypeId = data.account_type_id;
				this.accountTypeText = data.account_type_text;
				this.skills = data.skills;
				this.accolades = data.accolades;
			});
	}
}
</script>

<style scoped>

</style>