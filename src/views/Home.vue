<template>
    <div>
	    <Card v-for="post in feed" v-bind:key="feed.guid" class="mb-8">
		    <h3>
			    {{ post.description }}
		    </h3>

		    <p>
			    {{ post.description }}
		    </p>

		    <template v-slot:footer>
			    <a :href="feed.link">
				    Read more...
			    </a>
		    </template>
	    </Card>

<!--        <Card>-->
<!--            <p>-->
<!--                This application allows you to connect to a game's (Old School Runescape) high scores and view various information about an account.-->
<!--            </p>-->
<!--            To accomplish this:-->
<!--            <ol>-->
<!--                <li>Create an account under the 'register' menu option <em>("Settled" can be a username if you don't know one)</em></li>-->
<!--                <li>Click the 'Profile' menu option to see relevant stats</li>-->
<!--            </ol>-->

<!--            <hr>-->

<!--            To create a home-page post, you must be an admin user. There is a boolean column in the 'user' table that can be updated quick to view that functionality-->

<!--            <template v-slot:footer>-->
<!--                {{ footerText }}-->
<!--            </template>-->
<!--        </Card>-->
    </div>
</template>

<script>
    import Card from "./partials/Card";
    import Request from "../helpers/Request";

    export default {
        name: 'Home',
        components: {Card},
        data() {
            return {
                footerText: 'There are currently no posts. Sign in or create an account and create the first!',
	            feed: []
            }
        },
	    created() {
		    let request = new Request('RS/Home');
		    request.call()
			    .then(data => this.feed = data.channel.item);
	    }
    }
</script>

<style scoped>

</style>