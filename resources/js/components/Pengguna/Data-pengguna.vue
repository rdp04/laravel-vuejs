<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data User
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success" @click="showModal">Tambah Pengguna</button>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Email</th>
                                        <th>*</th>
                                    </tr>
                                    <tr v-for="item in users" :key="item.id">
                                        <td></td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.departemen_id}}</td>
                                        <td>{{item.email}}</td>
                                        <td>
                                            <a href="#" @click="showModalEdit(item)"><i class="fa fa-edit blue"></i> Edit</a>
                                            | 
                                            <a href="#" @click="deleteData(item.id)"> <i class="fa fa-trash-alt red"></i> Hapus</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="modalmuncul" tabindex="-1" role="dialog" aria-labelledby="modalmuncul1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="!statusmodal">Tambah Pengguna</h5>
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="statusmodal">Ubah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="statusmodal ? ubahData() : simpanData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" v-model="form.name" class="form-control" placeholder="Nama Karyawan" :class="{'is-invalid' : form.errors.has('name')}" required>
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <select v-model="form.departemen_id" class="form-control select2" :class="{'is-invalid' : form.errors.has('departemen_id')}" required>
                                <option value="">Pilih departemen</option>
                                <option v-for="item in departemens" :key="item.id" :value="item.id">{{item.nama_departemen}}</option>
                            </select>
                                <has-error :form="form" field="departemen_id"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.email" type="text" class="form-control" placeholder="Email" :class="{'is-invalid' : form.errors.has('email')}" required>
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Password" :class="{'is-invalid' : form.errors.has('password')}" required>
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" :disabled="disabled" v-show="!statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Simpan</button>
                        <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Ubah</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
    </div>
</template>

<script src="{{asset('js/app.js')}}"></script>
<script>
import Form from 'vform'
    export default {
        data(){
            return{
                loading: false,
                disabled: false,
                departemens: {},
                users: {},
                statusmodal:false,
                form: new Form({
                    id:"",
                    name:"",
                    departemen_id:"",
                    email:"",
                    password:""
                })
                
            };
        },
        methods:{
            showModal(){
                this.statusmodal = false;
                this.form.reset();
                $("#modalmuncul").modal("show");
            },
            showModalEdit(item){
                this.statusmodal = true;
                this.form.reset();
                $("#modalmuncul").modal("show");
                this.form.fill(item);
            },
            loadData(){
                this.$Progress.start(); 
                axios
                .get('api/ambildatadepartemen')
                .then(({data})=>(this.departemens = data));
                axios
                .get('api/user')
                .then(({data})=>(this.users = data));
                this.$Progress.finish();
            },
            simpanData(){
                this.$Progress.start(); 
                this.loading = true;
                this.disabled= true;
                this.form
                .post('api/user').then(() => {
                    Fire.$emit("refreshData");
                    $("#modalmuncul").modal("hide");
                    Toast.fire({
                    icon: 'success',
                    title: 'Data Berhasil Tersimpan'
                    });
                    this.$Progress.start(); 
                    this.loading = false;
                    this.disabled= false;
                })
                .catch(() => {
                    this.$Progress.fail(); 
                    this.loading = false;
                    this.disabled= false;
                });
            },
            ubahData(){
                this.$Progress.start(); 
                this.loading = true;
                this.disabled= true;
                this.form
                .put('api/user/' + this.form.id).then(() => {
                    Fire.$emit("refreshData");
                    $("#modalmuncul").modal("hide");
                    Toast.fire({
                    icon: 'success',
                    title: 'Data Berhasil Terupdate'
                    });
                    this.$Progress.start(); 
                    this.loading = false;
                    this.disabled= false;
                })
                .catch(() => {
                    this.$Progress.fail(); 
                    this.loading = false;
                    this.disabled= false;
                });
            },
            deleteData(id){
                Swal.fire({
                    title: "Anda Yakin Ingin Menghapus Data Ini?",
                    text: "Klik Batal Untuk Membatalkan Penghapusan",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButonText: "Hapus"
                }).then(result =>{
                    if(result.value){
                        this.form
                        .delete("api/user/" + id)
                        .then(() => {
                            Swal.fire(
                                "Terhapus",
                                "Data Anda Sudah Terhapus",
                                "Success"
                            );
                            Fire.$emit("refreshData");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Gagal",
                                "Data Gagal Terhapus",
                                "warning"
                            );
                        });
                    }
                });
            }
        },
        created(){
            this.loadData();
            Fire.$on("refreshData", () =>{
                this.loadData();
            });
        }
    }
</script>
