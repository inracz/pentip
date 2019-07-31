<template>
        <button class="btn ml-2 mr-2" @click="toggleBookmark" :class="{'btn-light' : hasBookmarked, 'btn-primary': !hasBookmarked}">
           {{ text }}
        </button>
</template>

<script>
    import axios from 'axios'

    export default {
        props: {
            default: Boolean,
            api: String
        },

        data: () => {
            return {
                text: '',
                hasBookmarked: false,
                count: 0
            }
        },

        methods: {
            toggleBookmark() {
                axios.post(this.api)
                    .then((response) => {
                        this.hasBookmarked = response.data.hasBookmarked
                        this.changeButton()
                    })
            },

            changeButton() {
                if (this.hasBookmarked) {
                    this.text = 'Remove the bookmark'
                } else {
                    this.text = 'Bookmark'
                }
            }
        },

        created() {
            this.hasBookmarked = this.default
            this.changeButton()
        }
    }
</script>