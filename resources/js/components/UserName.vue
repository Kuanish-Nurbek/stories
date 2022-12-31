<template>
    <button @click="toggle">{{ visible ? 'hide' : 'show' }}</button>
    <div v-if="visible">
        <form action="">
            <input type="text" class="name" v-model="name" >
            <input type="text" class="surname" v-model="surname">
        </form>
        {{ full }}
    </div>
    <div>
        <button @click="btnClick">click</button>
    </div>
    <!-- <div v-else>
        some text for else
    </div> -->

</template>

<script>
    import {mapGetters,mapActions} from 'vuex'

    export default {
        data() {
            return {
                name: '',
                surname:'',
                visible: true,
            }
        },
        computed: {
            full() {
                return  this.name + ' ' + this.surname
            },
            ...mapGetters([
                'TEST_STATE'
            ])
        },
        methods: {
            ...mapActions([
                'TOGGLE_TEST'
            ]),
            toggle(){
                this.visible = !this.visible;
            },

            btnClick(){
                // this.$emit('btnClicked','text');
                this.TOGGLE_TEST();
            }
        }
    }
</script>
