<template>
    <form @submit.prevent="onCreatePost">
        <input type="text" name="text" v-model="text">
        <input type="submit">
    </form>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                'text': ''
            };
        },
        methods: {
            onCreatePost() {
                axios.post('http://localhost/test/123',
                    {
                        text: this.text
                    }
                ).then(response => {
                    console.log(response);
                });
            }
        }
    }
</script>
