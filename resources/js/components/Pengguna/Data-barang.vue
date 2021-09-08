<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Barang
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
                                        <th>Nama</th>
                                        <th>Lokasi</th>
                                        <th>Tersedia</th>
                                        <th>Satuan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <tr v-for="item in barangs" :key="item.id">
                                        <td></td>
                                        <td>{{item.namabarang}}</td>
                                        <td>{{item.lokasi}}</td>
                                        <td>{{item.tersedia}}</td>
                                        <td>{{item.satuan}}</td>
                                        <td>{{item.keterangan}}</td>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="!statusmodal">Tambah Karyawan</h5>
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="statusmodal">Ubah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="statusmodal ? ubahData() : simpanData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" v-model="form.namabarang" class="form-control" placeholder="Nama Barang" :class="{'is-invalid' : form.errors.has('namabarang')}" required>
                            <has-error :form="form" field="namabarang"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.lokasi" type="text" class="form-control" placeholder="lokasi" :class="{'is-invalid' : form.errors.has('lokasi')}" required>
                            <has-error :form="form" field="lokasi"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.tersedia" type="text" class="form-control" placeholder="tersedia" :class="{'is-invalid' : form.errors.has('tersedia')}" required>
                            <has-error :form="form" field="tersedia"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.satuan" type="text" class="form-control" placeholder="satuan" :class="{'is-invalid' : form.errors.has('satuan')}" required>
                            <has-error :form="form" field="satuan"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.keterangan" type="text" class="form-control" placeholder="keterangan" :class="{'is-invalid' : form.errors.has('keterangan')}" required>
                            <has-error :form="form" field="keterangan"></has-error>
                        </div>
                        <!-- <div class="form-group">
                            <select v-model="form.departemen_id" class="form-control select2" :class="{'is-invalid' : form.errors.has('departemen_id')}" required>
                                <option value="">Pilih departemen</option>
                                <option v-for="item in departemens" :key="item.id" :value="item.id">{{item.nama_departemen}}</option>
                            </select>
                                <has-error :form="form" field="departemen_id"></has-error>
                        </div> -->
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
                barangs: {},
                // karyawans: {},
                statusmodal:false,
                form: new Form({
                    id:"",
                    namabarang:"",
                    lokasi:"",
                    tersedia:"",
                    satuan:"",
                    keterangan:"",
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
                // axios
                // .get('api/ambildatadepartemen')
                // .then(({data})=>(this.barangs = data));
                axios
                .get('api/barang')
                .then(({data})=>(this.barangs = data));
                this.$Progress.finish();
            },
            simpanData(){
                this.$Progress.start(); 
                this.loading = true;
                this.disabled= true;
                this.form
                .post('api/barang').then(() => {
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
                .put('api/barang/' + this.form.id).then(() => {
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
                        .delete("api/barang/" + id)
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
