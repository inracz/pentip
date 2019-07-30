<template>
    <!--<button @click.prevent="destroyPost()" class="btn btn-primary">Save</button>-->
</template>

<script>
    export default {/*
        props: ['api', 'form'],

        methods: {
            destroyPost() {
                var form = document.querySelector('#' + this.form)
                var data = {}

                Array.prototype.forEach.call(form.elements, function(element) {
                    data[element.name] = element.value
                });

                axios.post(this.api, data, 
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                ).then((response) => {
                    window.location = response.data.redirect
                })
                .catch((err) => {
                    alert('There was an error')
                })
            }
        }*/
    }
</script>