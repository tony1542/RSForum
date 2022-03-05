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
    import ThemeSwitcher from "./partials/ThemeSwitcher";

    export default {
        name: 'Home',
        components: {
            ThemeSwitcher,
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