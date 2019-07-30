<template>
<a class="card-link" href="#" @click.prevent="destroyPost">Delete this post</a>
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