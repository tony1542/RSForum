<template>
    <div class="row">
        <Card class="col">
            <template #header>
                {{ username }}
            </template>
            Account type: {{ accountTypeText }}
        </Card>

        <Card class="col">
            <h3>Skills</h3>
            <Skills :skills="skills" />
            <h3>Accolades</h3>
            <Accolades :accolades="accolades" />
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