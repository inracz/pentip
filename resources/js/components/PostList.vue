<template>
    <div class="posts">
        <div class="post" v-for="post in posts" :key="post.id">
            <img :src="post.thumbnail ? `storage/${post.thumbnail}` : '/images/default_thumbnail.jpg'" width="120px" style="padding: 10px">
            <div>
                <a :href="titleredirect + '/' + post.id">{{ post.title }}</a><br>
                <small>{{ post.created_at | formatDate }}</small>
                <p>by <a :href="userredirect + '/' + post.user.id">{{ post.user.name }}</a></p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: {
        titleredirect: String,
        userredirect: String,
        api: String,
    },

    data: () => {
        return {
            posts: [],
            next: ''
        }
    },

    methods: {
        appendPosts() {
            if (this.next != null) {
                axios.get(this.next)
                    .then((response) => {
                        console.log(response)
                        this.next = response.data.next_page_url
                        this.posts = this.posts.concat(response.data.data)
                    })
            }
        },

        scroll () {
            window.onscroll = () => {
                console.log("scrolled")
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;

                if (bottomOfWindow) {
                    this.appendPosts()
                }
            }
        },
    },

    created() {
        this.next = this.api
        this.appendPosts()
    },

    mounted() {
        this.scroll()
    }
}
</script>