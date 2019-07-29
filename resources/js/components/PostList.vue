<template>
    <div class="posts">
        <p v-if="posts.length == 0">No posts yet</p>

        <div class="post" v-for="post in posts" :key="post.id">
            <img :src="post.thumbnail ? `storage/${post.thumbnail}` : '/images/default_thumbnail.jpg'" width="120px" style="padding: 10px">
            <div>
                <a :href="titleredirect + '/' + post.id">{{ post.title }}</a><br>
                <small>{{ post.created_at | formatDate }} | {{ post.time_to_read }}m to read <br> {{ post.views }} views</small>
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
            posts: 'loading',
            next: ''
        }
    },

    methods: {
        appendPosts() {
            if (this.next != null) {
                axios.get(this.next, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response) => {
                        this.next = response.data.next_page_url

                        if (this.posts == 'loading')
                            this.posts = []

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