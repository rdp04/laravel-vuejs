<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Permintaan
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success" @click="showModal">Tambah Barang</button>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Kuantiti</th>
                                        <th>Satuan</th>
                                        <th>Peminta</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <tr v-for="item in permintaans" :key="item.id">
                                        <td></td>
                                        <td>{{item.barang.namabarang}}</td>
                                        <td>{{item.kuantiti}}</td>
                                        <td>{{item.satuan}}</td>
                                        <td>{{item.karyawan.nama}}</td>
                                        <td>{{item.keterangan}}</td>
                                        <td>
                                            <!-- <a href="#" @click="showModalEdit(item)"><i class="fa fa-edit blue"></i> Edit</a>
                                            | 
                                            <a href="#" @click="deleteData(item.id)"> <i class="fa fa-trash-alt red"></i> Hapus</a> -->
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modalmuncul" tabindex="-1" role="dialog" aria-labelledby="modalmuncul1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="!statusmodal">Tambah Permintaan</h5>
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="statusmodal">Ubah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="statusmodal ? ubahData() : simpanData()">
                    <div class="modal-body">
                        <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                        <div class="card-header">PEMESANAN</div>
                                    <div class="card-body">
                                    <h3>Form Pemesanan</h3>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                    <select v-model="form.id_peminta" class="form-control" :class="{'is-invalid' : form.errors.has('id')}" required>
                                                        <option value="">Nama Peminta</option>
                                                        <option v-for="item in karyawans" :key="item.id" :value="item.id">{{item.nama}}</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                <input disabled type="text" name="nama" placeholder="nama" class="form-control"> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                <input disabled type="text" name="departemen" placeholder="departemen" class="form-control"> 
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                    <select v-model="form.id_barang" class="form-control" :class="{'is-invalid' : form.errors.has('id')}" required>
                                                        <option value="">Barang</option>
                                                        <option v-for="barang in barangs" :key="barang.id" :value="barang.id">{{barang.namabarang}}</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                <input type="number" name="kuantiti" placeholder="kuantiti" class="form-control" v-model="form.kuantiti"> 
                                                </div>
                                                <div class="col-md-12">
                                                <input hidden type="number" name="kuantiti" placeholder="kuantiti" class="form-control" v-model="form.satuan" > 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-12">
                                                <input type="text" name="keterangan" placeholder="keterangan" class="form-control" v-model="form.keterangan"> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"  v-show="!statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Simpan</button>
                                                <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Ubah</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tr class="success"><th colspan="6">Detail Permintaan</th></tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Kuantiti</th>
                                            <th>Satuan</th>
                                            <th>Keterangan</th>
                                            <th>Peminta</th>
                                            <th></th>
                                        </tr>
                                        
                                        <tr  v-for="item in permintaans" :key="item.id">
                                            <td></td>
                                            <td>{{item.barang.namabarang}}</td>
                                            <td>{{item.kuantiti}}</td>
                                            <td>{{item.satuan}}</td> 
                                            <td>{{item.keterangan}}</td>
                                            <td>{{item.karyawan.nama}}</td>
                                            <td>
                                                <button  @click="cancel(item.id)" class="btn fas fa-trash-alt"></button>
                                            </td>
                                        <tr>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                permintaans: {},
                barangs: {},
                karyawans: {},
                statusmodal:false,
                form: new Form({
                    id:"",
                    id_barang:"",
                    kuantiti:"",
                    satuan:"PAK",
                    keterangan:"",
                    id_peminta:"",
                    status:"PENDING",
                })
                
            };
        },
        methods:{
            cancel(id){
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
                        .delete("api/permintaan/" + id)
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
            },
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
            loadKar(){
                this.$Progress.start(); 
                axios
                .get('api/ambildatakaryawan')
                .then(({data})=>(this.karyawans = data));
                this.$Progress.finish();
            },
            loadBar(){
                this.$Progress.start(); 
                axios
                .get('api/ambildatabarang')
                .then(({data})=>(this.barangs = data));
                this.$Progress.finish();
            },
            loadPer(){
                // this.$Progress.start(); 
                axios
                .get('api/permintaan')
                .then(({data})=>(this.permintaans = data));
                // this.$Progress.finish();
            },
            simpanData(){
                // this.$Progress.start(); 
                this.loading = true;
                this.disabled= true;
                this.form
                .post('api/permintaan').then(() => {
                    Fire.$emit("refreshData");
                    // $("#modalmuncul").modal("hide");
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
                .put('api/permintaan/' + this.form.id).then(() => {
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
                        .delete("api/permintaan/" + id)
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
            this.loadKar();
            Fire.$on("refreshData", () =>{
                this.loadKar();
            });
            this.loadBar();
            Fire.$on("refreshData", () =>{
                this.loadBar();
            });
            this.loadPer();
            Fire.$on("refreshData", () =>{
                this.loadPer();
            });
        }
    }
</script>
