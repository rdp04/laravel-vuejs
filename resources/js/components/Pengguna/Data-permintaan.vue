<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Permintaan
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success" @click="showModal">Tambah Permintaan Barang</button>
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
            <div class="modal fade bd-example-modal-lg" id="modalmuncul" tabindex="-1" role="dialog" aria-labelledby="modalmuncul1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="!statusmodal">Tambah Permintaan Barang</h5>
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-show="statusmodal">Ubah Permintaan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="statusmodal ? ubahData() : simpanData()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select v-model="form.id" class="form-control select2" :class="{'is-invalid' : form.errors.has('id')}" required>
                                        <option value="">NIK Peminta</option>
                                        <option v-for="item in karyawans" :key="item.id" :value="item.id">{{item.nik}}</option>
                                    </select>
                                        <has-error :form="form" field="id"></has-error>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input disabled v-model="form.nama" type="text" class="form-control" placeholder="nama" :class="{'is-invalid' : form.errors.has('nama')}" required>
                                    <has-error :form="form" field="nama"></has-error>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input disabled v-model="form.departemen" type="text" class="form-control" placeholder="departemen" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                    <has-error :form="form" field="departemen"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input v-model="form.lokasi" type="date" class="form-control" placeholder="departemen" :class="{'is-invalid' : form.errors.has('lokasi')}" required>
                                    <has-error :form="form" field="lokasi"></has-error>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>#</th>
                                                <th>Barang</th>
                                                <th>Lokasi</th>
                                                <th>Tersedia</th>
                                                <th>Kuantiti</th>
                                                <th>Satuan</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>*</th>
                                            </tr>
                                            <tr v-for="(input,k) in inputs" :key="k">
                                                <td></td>
                                                <td>
                                                   <select v-model="form.id" class="form-control" :class="{'is-invalid' : form.errors.has('id')}" required>
                                                        <option value="">Barang</option>
                                                        <option v-for="item in barangs" :key="item.id" :value="item.id">{{item.namabarang}}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input disabled v-model="form.departemen" type="text" class="form-control" placeholder="lokasi" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                                </td>
                                                <td>
                                                    <input disabled v-model="form.departemen" type="text" class="form-control" placeholder="tersedia" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                                </td>
                                                <td>
                                                    <input v-model="form.departemen" type="text" class="form-control" placeholder="kuantiti" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                                </td>
                                                <td>
                                                    <input disabled v-model="form.departemen" type="text" class="form-control" placeholder="satuan" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                                </td>
                                                <td>
                                                    <input v-model="form.departemen" type="text" class="form-control" placeholder="keterangan" :class="{'is-invalid' : form.errors.has('departemen')}" required>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <span>
                                                        <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                                        <i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1"></i>
                                                    </span>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-primary" :disabled="disabled" v-show="!statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Tambah</button>
                                <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Ubah</button>
                            </div>

                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="form-group">
                            <select v-model="form.id" class="form-control select2" :class="{'is-invalid' : form.errors.has('id')}" required>
                                <option value="">Pilih Barang</option>
                                <option v-for="item in barangs" :key="item.id" :value="item.id">{{item.namabarang}}</option>
                            </select>
                                <has-error :form="form" field="id"></has-error>
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
                            <input v-model="form.kuantiti" type="text" class="form-control" placeholder="kuantiti" :class="{'is-invalid' : form.errors.has('kuantiti')}" required>
                            <has-error :form="form" field="kuantiti"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.satuan" type="text" class="form-control" placeholder="satuan" :class="{'is-invalid' : form.errors.has('satuan')}" required>
                            <has-error :form="form" field="satuan"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.keterangan" type="text" class="form-control" placeholder="keterangan" :class="{'is-invalid' : form.errors.has('keterangan')}" required>
                            <has-error :form="form" field="keterangan"></has-error>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" :disabled="disabled" v-show="!statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Simpan</button>
                            <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Ubah</button>
                        </div>
                        
                        </div> -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" :disabled="disabled" v-show="!statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Simpan</button>
                            <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusmodal"> <i v-show="loading" class="fa fa-spinner fa-spin"></i> Ubah</button>
                        </div>
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
                inputs: [
                    {
                        name: ''
                    }
                ],
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
                    satuan:"",
                    id_peminta:"",
                    keterangan:"",
                })
                
            };
        },
        methods:{
            add(index) {
            this.inputs.push({ name: '' });
        },
        remove(index) {
            this.inputs.splice(index, 1);
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
            loadData(){
                this.$Progress.start(); 
                axios
                .get('api/barang')
                .then(({data})=>(this.barangs = data));
                axios
                .get('api/permintaan')
                .then(({data})=>(this.permintaans = data));
                axios
                .get('api/karyawan')
                .then(({data})=>(this.karyawans = data));
                this.$Progress.finish();
            },
            simpanData(){
                this.$Progress.start(); 
                this.loading = true;
                this.disabled= true;
                this.form
                .post('api/permintaan').then(() => {
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
            this.loadData();
            Fire.$on("refreshData", () =>{
                this.loadData();
            });
        }
    }
</script>
