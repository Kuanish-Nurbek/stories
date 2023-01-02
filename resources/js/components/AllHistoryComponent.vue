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

        <!-- после получение data заполняем массив arrCounter с данными типа [5,10,15,20] для пагинации от сюда потом возьмем start and count-->
        <template v-if="data">{{ makeArrCounter() }}</template>

        <template v-if="data" v-for="(item, index) in data.slice(start,count)" :key="item.id">

                <div v-if="first" class="accordion-item">
                    {{ firstTogle() }} <!-- здесь значение first делаем false -->

                    <h2 class="accordion-header" :id="'header'+index">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="true" :aria-controls="'teg'+index">
                        {{item.title}}
                    </button>
                    </h2>
                    <div :id="'teg'+index" class="accordion-collapse collapse show" :aria-labelledby="'header'+index" data-bs-parent="#accordionExample">
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


                <div v-else-if="!first" class="accordion-item">
                    <h2 class="accordion-header" :id="'header'+index">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="false" :aria-controls="'teg'+index">
                            {{item.title}}
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
        <!-- здесь значение first делаем true d -->
        {{ firstTogle() }}      <!-- для проверки первого элемента аккордиона возвращает  true or false -->

    </div>

    <template v-if="data">  <!-- после получение data -->
        <nav aria-label="Пример навигации по страницам" class="mt-3 row justify-content-center">
            <ul class="pagination col-4">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Предыдущая">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                 <!-- перебор пагинацию в зависимости от длины массива с данными и (сколько элементов должен быть на странице) -->
                <template v-for="i in Math.ceil(data.length / show)">
                    <template v-if="i == 1">
                        <li class="page-item"><a class="page-link page"  id="active" :href="'#'+i" @click="changePage(i,$event)">{{ i }} </a></li>
                    </template>
                    <template v-else>
                        <li class="page-item"><a class="page-link page" id="" :href="'#'+i" @click="changePage(i,$event)">{{ i }} </a></li>
                    </template>
                </template>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Следующая">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </template>




</template>
<script>
    import axios from 'axios';

    export default {
        mounted() {
                axios.post('/histories/change_select_axios',{/* здесь можно передавать какие то данные */})
                .then(response => {
                    /* здесь мы можем выводить ответ в консоль или записать эти данные куда то */
                    console.log(response.data);
                    this.data = response.data;
                });
        },
        data() {
            return {
                count: 5,
                show: 5, // используется для постороения пагинации и для построения arrCounter в методе makeArrCounter()
                start: 0,
                data: null,
                first: true,
                arrCounter: [],
            };
        },
        methods: {
            onCreatePost() {
                axios.post('/test/123',{/* здесь можно передавать какие то данные */}
                ).then(response => {
                    /* console.log(response); здесь мы можем выводить ответ в консоль или записать эти данные куда то */
                });
            },

            changeSelect(event) {
                this.show = Number(event.target.value);     // здесь берем

                this.count = Number(event.target.value);       // здесь меняем все данные при изменении селекта
                this.start = 0;

                axios.post('/histories/change_select_axios',
                    {
                        selected: event.target.value,
                    }
                ).then(response => {
                    console.log(response.data);
                    this.data = response.data;
                });
                this.arrCounter.length = 0;



                if(document.querySelector('.pagination')){
                    if(document.getElementById('active')){
                        document.getElementById("active").id = "";
                    }
                    document.querySelector('.pagination .page').id = 'active';
                }

            },
            firstTogle() {
                this.first = !this.first
            },
            changePage(i,event){
                this.start = this.arrCounter[i-1];
                if(i == 1){
                    this.count = this.arrCounter[i-1] + this.arrCounter[i];

                }else {
                    this.count = this.arrCounter[i-1] + this.arrCounter[1];
                }

                if(document.getElementById('active')){
                    document.getElementById("active").id = "";
                }

                event.target.setAttribute("id", "active")

            },
            makeArrCounter() {
                this.arrCounter.length = 0;

                for (let index = 1; index < Math.ceil(this.data.length / this.show); index++) {
                    if(this.arrCounter.length === 0){
                        this.arrCounter[0] = 0;
                        this.arrCounter[index] = this.show;
                    }else {
                        this.arrCounter[index] = this.arrCounter[index - 1] + this.show;
                    }
                }
            }
        }
    }
</script>

<style>
    #active {
        background-color: #E7F1FF !important;
    }
</style>
