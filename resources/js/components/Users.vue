<template>
    <div v-for="user in users" :key="user.id">
        {{ user.email }}
    </div>
    <button class="btn btn-danger" v-on:click="decrease">click</button>
    <button class="btn btn-success" v-on:click=encrease>click</button>
    <a href="/" v-on:click="get()">отправить</a>

    <p>{{ counter }}</p>


    {{ info }}


</template>

<script>
    import axios from 'axios';


    export default {
        mounted() {
            this.updated(),
            axios
                .get('https://api.coindesk.com/v1/bpi/currentprice.json')
                .then(response => (this.info = response));

        },
        props: {
            users: []
        },

        data() {
            return {
                info: null,
                counter: 1
            }
        },
        methods:{
            // get() {
            //     axios({
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json'
            //         },
            //         data: {
            //             sel1: '2',
            //             sel2: '5',
            //         },
            //         url: '/',
            //         responseType: 'json'
            //         })
            //         .then(response => (this.items = response.data))
            //         .catch(function(error) {
            //         console.log(error)
            //     })
            // },
            updated() {
                console.log(this.users)
            },
            encrease() {
                this.counter = this.counter + 1
            },
            decrease() {
                this.counter = this.counter - 1
            },
        },

    }


</script>
