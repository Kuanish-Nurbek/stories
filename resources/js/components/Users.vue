<template>
    <div v-for="user in users" :key="user.id">
        {{ user.email }}
    </div>
    <button class="btn btn-danger" v-on:click="decrease">click</button>
    <button class="btn btn-success" v-on:click=encrease>click</button>

    <p>{{ counter }}</p>
    <p>{{ show() }}</p>
</template>

<script>


    export default {
        props: {
            users: Array
        },
        data() {
            return {
                counter: 1
            }
        },
        methods:{
            show() {
                alert('hello world');
            },
            encrease() {
                this.counter = this.counter + 1
            },
            decrease() {
                this.counter = this.counter - 1
            }
        }
    }


</script>
