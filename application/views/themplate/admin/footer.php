
 
 <!-- modal tambah Kategori -->
 <div class="modaDataTransaksi modal fade" id="modaDataTransaksi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modaDataTransaksi" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Data Transakasi Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <h2 class="judul-pinjaman">Informasi Anggota</h2>
                    <div class="box-informasi-peminjaman">
                        <ul class="list-group">
                            <!-- di isi dari ajax -->
                        </ul>
                    </div>
                    <h2 class="judul-pinjaman">Peminjaman Reguler</h2>
                    <div class="box-table-pinjaman-reguler">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Buku</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Tagal Pinjam</th>
                                <th scope="col">Lama</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>    
                    </div>
                    <h2 class="judul-pinjaman">Peminjaman Buku Kelas</h2>
                    <h2 class="judul-pinjaman">Peminjaman Buku Kelas</h2>
                </div>
            </div>
            <!-- end modal  -->
        </div>
        <!-- end modal dialog -->
    </div>
    <!-- end Modal Tambah Kategori======================================================================== -->
</div>
<!-- akhir container utama -->
<!-- jquer -->
<script src="<?=base_url()?>assets/Backend/assets/js/jquery-3.5.1.min.js"></script>
<!-- bootrap -->
<script src="<?=base_url()?>assets/Backend/assets/js/bootstrap.min.js"></script>
<!-- dataTables Javasctp -->
<script src="<?=base_url()?>assets/DataTables/datatables.min.js"></script>
<script src="<?=base_url()?>assets/DataTables/Bootstrap-4-4.1.1/css/bootstrap.min.css.map"></script>
<!-- sweet aler -->
<script src="<?=base_url()?>assets/Backend/assets/js/sweetalert2.all.js"></script> 
<!-- jquery validation -->
<script src="<?=base_url()?>assets/jquery-validation/dist/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/jquery-validation/dist/additional-methods.min.js"></script>

<!-- main javascrip -->
<script src="<?=base_url()?>assets/Backend/assets/js/script.js"></script>
</body>
</html>