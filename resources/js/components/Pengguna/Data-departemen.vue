<template>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Departemen</div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <tr v-for="item in departemens" :key="item.id">
                                        <td></td>
                                        <td>{{item.nama_departemen}}</td>
                                        <td></td>
                                        
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                departemens :{}
            };
        },
        methods:{
            loadData(){
                this.$Progress.start(); 
                axios.get('api/ambildatadepartemen').then(({data})=>(this.departemens = data));
                this.$Progress.finish(); 
            }
        },
        created(){
            this.loadData();
        }
    }
</script>
