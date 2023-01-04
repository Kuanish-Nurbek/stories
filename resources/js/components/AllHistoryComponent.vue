<template>

    <div class="search mb-5">
        <div class="main-histories__title text-center p-3 mt-5 mb-2 rounded" style = "background-color:#E9E8DD;">
            <h4 class="main-histories__title_text title">Пойск истории по хештегу</h4>
        </div>
        <form @submit.prevent>
            <div class="mb-3">
                <label for="exampleInputEmail1" class=" form-text">Введите хештег без '#' пример: sport travel</label>
                <input type="search" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="searchData" @change="searchOfhashtag($event)">
                <label v-if="dataFromSearch && dataFromSearch.length > 0" for="exampleInputEmail1" class=" form-text">{{ 'Найдено ' + dataFromSearch.length + (dataFromSearch.length === 1 ? ' история' : ' историй') + ' по данному хештегу' }}</label>
                <label v-if="dataFromSearch && dataFromSearch.length == 0" for="exampleInputEmail1" class=" form-text">{{ 'По данному хештегу историй не найдено' }}</label>
            </div>

        </form>
    </div>


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


        <template v-if="data" v-for="(item, index) in (dataFromSearch !== null && dataFromSearch.length > 0) ? dataFromSearch.slice(start,count) : data.slice(start,count)" :key="item.id">

            <div v-if="index === 0" class="accordion-item mb-3">
                <h2 class="accordion-header" :id="'header'+index">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="true" :aria-controls="'teg'+index">
                    <span>{{item.title}}</span> <span class="ms-3" v-for="item in item.hashtag.split(' ')">{{'#' +item}}</span>
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

            <div v-else-if="index !== 0" class="accordion-item mb-3">
                <h2 class="accordion-header" :id="'header'+index">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#teg'+index" aria-expanded="false" :aria-controls="'teg'+index">
                        <span>{{item.title}}</span> <span class="ms-3" v-for="item in item.hashtag.split(' ')">{{'#' +item }}</span>
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
                    <template v-for="i in Math.ceil((dataFromSearch !== null ? dataFromSearch.length : data.length) / show)">
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
        <!-- {{ firstTogle }} -->
    </div>

</template>




<script>
    import axios from 'axios';
    import { ref } from 'vue';

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
                dataFromSearch: null,
                first: true,
                arrCounter: [],
                arrCounterLength: null,
                searchData: null,
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
                for (let index = 0; index < Math.ceil(this.dataFromSearch !== null ? this.dataFromSearch.length : this.data.length / this.show); index++) {
                    if(this.getArrLength == 0){
                        this.arrCounter[0] = 0;
                    }else {
                        this.arrCounter[index] =  this.arrCounter[index - 1] + this.show;
                        // console.log(this.show);
                    }
                };
            },
        },
        methods: {
            searchOfhashtag(event){
                let searchData = this.searchData
                let data = this.data;
                if(event.target.value){
                    this.dataFromSearch = data.filter((item) => item['hashtag'].indexOf(searchData) !== -1);
                    console.log(this.dataFromSearch = data.filter((item) => item['hashtag'].indexOf(searchData) !== -1));
                }else{
                    this.dataFromSearch = null;
                }
            },
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
