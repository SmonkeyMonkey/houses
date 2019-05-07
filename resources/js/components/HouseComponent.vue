<template>
    <div>
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="filter-tab" data-toggle="tab" href="#filter" role="tab" aria-controls="filter" aria-selected="true">Фильтры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">Загрузка</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="filter" role="tabpanel" aria-labelledby="filter-tab">
                    <form class="d-flex justify-content-around">
                        <div class="filter">
                            <input v-model="name" type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="filter">
                            <input v-model="bedrooms" type="number" class="form-control" placeholder="Спальни">
                        </div>
                        <div class="filter">
                            <input v-model="bathrooms" type="number" class="form-control" placeholder="Ванные комнаты">
                        </div>
                        <div class="filter">
                            <input v-model="storeys" type="number" class="form-control" placeholder="Этажи">
                        </div>
                        <div class="filter">
                            <input v-model="garages" type="number" class="form-control" placeholder="Гаражи">
                        </div>
                        <div class="submit">
                            <button type="submit" @click.prevent="fetch" class="btn btn-primary" >
                                Поиск
                            </button>
                        </div>

                    </form>
                </div>
                <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                    <label>CSV
                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                    </label>
                    <button v-on:click="uploadCsv()">Submit</button>
                </div>
            </div>
            <div v-if="showmsg" class="alert alert-success" role="alert">
                file uploaded
            </div>
            <div class="container">
                <div class="large-12 medium-12 small-12 cell">

                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Bedrooms</th>
                    <th scope="col">Bathrooms</th>
                    <th scope="col">Storeys</th>
                    <th scope="col">Garages</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="house in houses">
                    <th scope="row">{{ house.id }}</th>
                    <td>{{ house.name }}</td>
                    <td>{{ house.price }}</td>
                    <td>{{ house.bedrooms }}</td>
                    <td>{{ house.bathrooms }}</td>
                    <td>{{ house.storeys }}</td>
                    <td>{{ house.garages }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name : null,
                price : null,
                bedrooms : null,
                bathrooms : null,
                storeys : null,
                garages : null,
                houses: [],
                file:'',
                showmsg: false,
            }
        },
        methods: {
            fetch(){
                axios.get('api/houses',{
                    params:{
                        name : this.name,
                        bedrooms : this.bedrooms,
                        bathrooms: this.bathrooms,
                        storeys: this.storeys,
                        garages: this.garages,
                    }
                })
                    .then(response => {
                        this.houses = response.data
                    })
            },
            uploadCsv(){
                let file = new FormData();
                file.append('file',this.file);
                axios.post('api/import',
                file,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                    ).then(response =>{
                    this.showmsg = true,
                    this.fetch(),
                        setTimeout(() => {
                            this.showmsg = false;
                        }, 3000);
                })
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        },
        mounted(){
            this.fetch()
        }
    }
</script>

<style scoped>

</style>
