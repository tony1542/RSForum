<template>
    <div class="row">
        <div class="col-md-3 pb-3">
            <Card>
                <h5 class="card-title">
                    {{ username }}
                </h5>
			
                Account type: {{ accountTypeText }}
            </Card>
        </div>
	    
        <div class="col-md-9">
            <Card>
                <h3>Skills</h3>
                <Skills :skills="skills" />
                <h3>Accolades</h3>
                <Accolades :accolades="accolades" />
            </Card>
        </div>
    </div>
</template>

<script>
    import Request from "../helpers/Request";
    import Accolades from "./partials/account/Accolades.vue";
    import Skills from "./partials/account/Skills.vue";
    import Card from "./partials/Card.vue";

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