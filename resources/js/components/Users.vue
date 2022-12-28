<template>
    <button class="btn btn-danger" @click="updateCount(-1)">-</button>
    {{ count }}
    <button class="btn btn-success" @click="updateCount(+1)">+</button>
    <div  v-for="user in users.slice(0,count)" :key="user.id" >
        <p>{{ user.email }}</p>
    </div>


    <form action="/test/123" method="POST">
        <input type="hidden" name="_token" :value="token" />
        <input type="text">
        <input name="id" type="submit" @click="send()">
    </form>

    <button @click="get()"></button>

    {{ token }}
    <!-- {{ info }} -->
    {{ item }}

</template>

<script>
// import { vModelCheckbox } from 'vue';




    // axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')




    export default {
        mounted() {
            // axios.get('https://jsonplaceholder.typicode.com/todos/1').then(response => (this.info = response))

            // axios.get('/?id=' + this.counter).then(function (response){
            //     console.log(response);
            // }).then(function(){}).then(json => console.log(json))
                this.tok = this.token
        },
        props: {
            users: [],
            token: '',
        },

        data() {
            return {
                info: null,
                count: 5,
                item: '',
                tok: null
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
            get(){
                // axios.post('/','123').then(function (response){
                //     this.$data.item = response.config.data;
                //     // console.log(response.config.data);

                // }).then(function(){})

                axios.post('/',this.count).then(response => (this.item = response.config.data))
                // axios.post('/','123').then(response => (console.log(response.config.data)))
            },

            send(){
                // axios.post('/test/123',{
                //     'name' : 'Nurbek',
                //     'age' : '27'
                // }).then(response => (console.log(response.config.data))).catch(function(error){
                //     console.log(error)
                // })

                axios.post('', {
                    firstName: 'Fred',
                    lastName: 'Flintstone'
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            updateCount(change) {
                this.count = Math.max(0, Math.min(10, this.count + change));
            },

        }

    }


</script>
