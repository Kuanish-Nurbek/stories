<template>

    <span v-if="TEST_STATE">UserTest</span>

</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        props: {
            isVisibleBlockTest: false,
            text: '',
        },
        computed: {
            ...mapGetters([
                'TEST_STATE'
            ])
        },
       data() {
            return {
                test: 'test'
            }
       }
    }
</script>
