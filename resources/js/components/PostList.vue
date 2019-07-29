<template>
    <div class="posts">
        <p v-if="posts.length == 0">No posts yet</p>

        <div class="card post" style="max-width: 540px;" v-for="post in posts" :key="post.id" width="120px">
            <div class="row no-gutters">
                <div class="col-md-4 thumbnail">
                    <img :src="post.thumbnail ? `storage/${post.thumbnail}` : '/images/default_thumbnail.jpg'" class="card-img" alt="...">
                    <span class="timeToRead badge badge-dark">{{ post.time_to_read }} min</span>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><a class="card-link" :href="titleredirect + '/' + post.id">{{ post.title }}</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><a class="card-link" :href="userredirect + '/' + post.user.id">@{{ post.user.name }}</a></h6>
                        <p class="card-text"><small class="text-muted"></small></p>
                        <p class="card-text">
                            <small class="text-muted">
                                Posted {{ post.created_at | formatDate }}<br>
                                {{ post.views }} views
                            </small>
                        </p>
                    </div>
                </div>
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