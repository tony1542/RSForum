<template>
    <div>
        <Card class="mb-8">
            <p>
                This application allows you to connect to a game's (Old School Runescape) high scores and view various information about an account.
            </p>
            To accomplish this:
            <ol>
                <li>Create an account under the 'register' menu option <em>("Settled" can be a username if you don't know one)</em></li>
                <li>Click the 'Profile' menu option to see relevant stats</li>
            </ol>

            <template #footer>
                {{ footerText }}
            </template>
        </Card>

        <Card
            v-for="post in feed"
            :key="post.guid"
            class="mb-8"
        >
            <template #header>
                {{ post.title }}
            </template>

            <div class="flex align-items-center row">
                <div class="pr-6 col-md-6 col-lg-3">
                    <img
                        class="img-fluid"
                        :src="post.enclosure['@attributes'].url"
                        alt="Descriptive Image"
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
    import Card from "./partials/Card";
    import Request from "../helpers/Request";

    export default {
        name: 'Home',
        components: {
            Card
        },
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