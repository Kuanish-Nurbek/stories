<template>

    <div class="form-text">Вы можете выбрать сколько историй показать на одной странице</div>

    <form action="/public/histories/change_select" style="display: block; text-align:right;" method="POST" class="mb-3">
        <select @change="changeSelect($event)" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option name=select-item value="5">5  </option>
            <option name=select-item value="10">10</option>
            <option name=select-item value="15">15</option>
            <option name=select-item value="20">20</option>
            <option name=select-item value="30">30</option>
            <option name=select-item value="50">50</option>
        </select>
    </form>



    <div class="accordion" id="accordionExample">

        <!-- после получение data заполняем массив arrCounter с данными типа [5,10,15,20] для пагинации от сюда потом возьмем start and count-->
        <template v-if="data">{{ makeArrCounter }}</template>

        <template v-if="data" v-for="(item, index) in data.slice(start,count)" :key="item.id">

            <div v-if="first" class="accordion-item mb-3">
                {{ firstTogle }} <!-- здесь значение first делаем false -->

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

            <div v-else-if="!first" class="accordion-item mb-3">
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





        <template v-if="data">  <!-- после получение data -->
            <nav aria-label="Пример навигации по страницам" class="mt-3 row justify-content-center">
                <ul class="pagination col-4 justify-content-center">
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
        <!-- здесь значение first делаем true d -->
        {{ firstTogle }}      <!-- для проверки первого элемента аккордиона возвращает  true or false -->
    </div>

</template>




<script>
    import axios from 'axios';

    export default {
        mounted() {
                axios.post('/histories/change_select_axios',{})
                .then(response => {
                    // console.log(response.data);
                    this.data = response.data;
                });
        },
        props: {

        },
        data() {
            return {
                count: 5,
                show: 5,
                start: 0,
                data: null,
                first: true,
                arrCounter: [],
                arrCounterLength: null,
            };
        },
        computed: {
            getArrLength(){
               return this.arrCounter.length;
            },
            setEmptyArr(){
               return this.arrCounter = [];
            },
            dataLength(){
                if(this.data){
                    return this.data.length;
                }
            },
            math(){
                // console.log(Math.ceil(this.data.length / this.show));
                if(this.data){
                    return Math.ceil(this.data.length / this.show);
                }
            },
            makeArrCounter() {
                this.arrCounter = [];
                for (let index = 0; index < Math.ceil(this.data.length / this.show); index++) {
                    if(this.getArrLength == 0){
                        this.arrCounter[0] = 0;
                    }else {
                        this.arrCounter[index] =  this.arrCounter[index - 1] + this.show;
                        console.log(this.show);
                    }
                };
            },
            firstTogle() {
                this.first = !this.first
            },

        },
        methods: {
            onCreatePost() {
                axios.post('http://localhost/test/123',
                    {
                        text: this.text
                    }
                ).then(response => {
                    // console.log(response);
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
                    // console.log(response.data);
                    this.data = response.data;
                });

                if(document.querySelector('.pagination')){
                    if(document.getElementById('active')){
                        document.getElementById("active").id = "";
                    }
                    document.querySelector('.pagination .page').id = 'active';
                }

            },
            changePage(i,event){
                if(i == 1 && this.arrCounter.length === 1){
                    this.count = this.show;
                    this.start = 0;
                }
                else if(i == 1){
                    this.count = this.arrCounter[i-1] + this.arrCounter[i];
                    this.start = 0;
                }else {
                    this.count = this.arrCounter[i-1] + this.arrCounter[1];
                    this.start = this.arrCounter[i-1];
                }

                if(document.getElementById('active')){
                    document.getElementById("active").id = "";
                }

                event.target.setAttribute("id", "active")

            },
        }
    }
</script>

<style>
    #active {
        background-color: #E7F1FF !important;
    }
</style>
