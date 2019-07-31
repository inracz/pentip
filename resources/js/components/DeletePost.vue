<template>
    <button class="btn btn-light ml-2 mr-2" @click.prevent="destroyPost">Delete this post</button>
</template>

<script>
    export default {
        props: ['api', 'redirect'],

        methods: {
            destroyPost() {
                axios.delete(this.api).then((response) => {
                    window.location = this.redirect
                })
                .catch((err) => {
                    alert('There was an error')
                })
            }
        }
    }
</script>