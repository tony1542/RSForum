<template>
    <div>
        <NewsPost
            v-for="post in feed"
            :key="post.guid"
            :post="post"
        />
    </div>
</template>

<script>
    import Request from "../helpers/Request";
    import NewsPost from "./partials/NewsPost";

    export default {
        name: 'Home',
        components: {
            NewsPost
        },
        data() {
            return {
                feed: []
            }
        },
        created() {
            let request = new Request('ExternalFeed/Home');
            request.call()
                .then(data => this.feed = data.channel.item);
        }
    }
</script>

<style scoped>

</style>