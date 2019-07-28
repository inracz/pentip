<template>
    <p>
        {{ count }}
        <button class="like" @click="toggleLike" :class="{'unactive' : !hasLiked}">
            {{ text }}
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
                    this.text = 'Unlike'
                } else {
                    this.text = 'Like'
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

<style>
    button.like {
        border: 0;
        display: inline-block;
        padding: 10px 15px;
    }

    button.like.unactive {
        background-color: cornflowerblue;
        color: white;
    }

</style>