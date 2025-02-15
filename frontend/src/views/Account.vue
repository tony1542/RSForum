<template>
	<div class="row">
		<Card class="mb-4">
			<h5 class="card-title">
				{{ username }}
			</h5>
			
			Account type: {{ accountTypeText }}
		</Card>
		
		<SkillTable :skills="skills"/>
		<AccoladeTable :accolades="accolades" />
	</div>
</template>

<script>
import Request from "../helpers/Request";
import Card from "./partials/Card.vue";
import SkillTable from "./partials/account/SkillTable.vue";
import AccoladeTable from "./partials/account/AccoladeTable.vue";

export default {
	name: "Account",
	components: {
		AccoladeTable,
		SkillTable,
		Card,
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