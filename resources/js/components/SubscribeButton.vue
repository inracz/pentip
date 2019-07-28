<template>
    <button class="sub" @click="toggleSubscribe" :class="{'unactive' : !isSubscribed}">
        {{ text }}
    </button>
</template>

<script>
    import axios from 'axios'

    export default {
        props: {
            user: Number,
            default: Boolean
        },

        data: () => {
            return {
                text: 'Subscribe',
                isSubscribed: false
            }
        },

        methods: {
            toggleSubscribe() {
                axios.post(Laravel.baseUrl + '/users/' + this.user + '/toggleSubscribe')
                    .then((response) => {
                        this.isSubscribed = response.data.isSubscribed
                        this.changeButton()
                    })
            },

            changeButton() {
                if (this.isSubscribed) {
                    this.text = 'Unsubscribe'
                } else {
                    this.text = 'Subscribe'
                }
            }
        },

        created() {
            this.isSubscribed = this.default
            this.changeButton()
        }
    }
</script>

<style>
    button.sub {
        border: 0;
        display: inline-block;
        padding: 10px 15px;
    }

    button.sub.unactive {
        background-color: cornflowerblue;
        color: white;
    }

</style>