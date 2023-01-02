<template>
    <div class="form-text">Вы можете выбрать сколько историй показать на одной странице</div>
    <form action="/public/histories/change_select" style="display: block; text-align:right;" method="POST" class="mb-3">
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Тайтл</th>
                                    <th scope="col">Текст </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{item.title}}</td>
                                    <td>{{item.text}}</td>
                                </tr>
                            </tbody>
                        </table>
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
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Тайтл</th>
                                    <th scope="col">Текст</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{item.title}}</td>
                                    <td>{{item.text}}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
        </template>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        mounted() {
                axios.post('/histories/change_select_axios',{})
                .then(response => {
                    console.log(response.data);
                    this.data = response.data;
                });
        },
        data() {
            return {
                text: '',
                num: 5,
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
