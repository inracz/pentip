<template>
    <p>
        
        <button class="btn" @click="toggleLike" :class="{'btn-outline-primary' : hasLiked, 'btn-primary': !hasLiked}">
           {{ count }} {{ text }}
        </button>
    </p>
</template>

<script>
    import axios from 'axios'

    export default {
        props: {
            default: Boolean,
            likes: Number,
            api: String
        },

        data: () => {
            return {
                text: '',
                hasLiked: false,
                count: 0
            }
        },

        methods: {
            toggleLike() {
                axios.post(this.api)
                    .then((response) => {
                        this.hasLiked = response.data.hasLiked
                        this.count = response.data.likes
                        this.changeButton()
                    })
            },

            changeButton() {
                if (this.hasLiked) {
                    this.text = 'likes'
                } else {
                    this.text = 'likes'
                }
            }
        },

        created() {
            this.hasLiked = this.default
            this.count = this.likes
            this.changeButton()
        }
    }
</script>