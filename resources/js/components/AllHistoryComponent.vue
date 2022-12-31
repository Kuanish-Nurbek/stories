<template>

    <form action="/public/histories/change_select" style="display: block; text-align:right;" method="POST">
        <select @change="changeSelect($event)" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option name=select-item value="5"  >5</option>
            <option name=select-item value="10"  >10</option>
            <option name=select-item value="20"  >20</option>
            <option name=select-item value="30"  >30</option>
            <option name=select-item value="50" >50</option>
        </select>
    </form>
    <div class="accordion" id="accordionExample">
        <template v-for="(item, index) in data" :key="item.id">
                <div v-if="index == 0 && index < num" class="accordion-item 111">
                    <h2 class="accordion-header" :id="'header'+index">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="true" :aria-controls="'teg'+index">
                        {{item.title}} #{{index+1}}
                    </button>
                    </h2>
                    <div :id="'teg'+index" class="accordion-collapse collapse show" :aria-labelledby="'header'+index" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                    </div>
                </div>


                <div v-else-if="index > 0 && index < num" class="accordion-item">
                    <h2 class="accordion-header" :id="'header'+index">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="false" :aria-controls="'teg'+index">
                            {{item.title}} #{{ index+1 }}
                        </button>
                    </h2>
                    <div :id="'teg'+index" class="accordion-collapse collapse" :aria-labelledby="'header'+index" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>

        </template>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                text: '',
                num: 0,
                data: null,
                first: true,

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
            },
            changeSelect(event) {
                this.num = event.target.value;
                axios.post('/histories/change_select_axios',
                    {
                        selected: event.target.value,
                    }
                ).then(response => {
                    console.log(response.data);
                    this.data = response.data;
                });
            }
        }
    }
</script>
