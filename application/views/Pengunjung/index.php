<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <!-- bostrap csss -->
    <link rel="stylesheet" href="<?=base_url('assets/Backend/')?>assets/css/bootstrap.min.css">
    <!-- owlCarose -->
    <link rel="stylesheet" href="<?=base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/Backend/')?>node_modules/chart.js/dist/Chart.css">
    <link rel="stylesheet" href="<?=base_url('assets/Backend/')?>assets/scss/userStyle.css">

</head>

<body>
<input type="hidden" class="url" value="<?=base_url()?>">
<input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
<div class="loading d-flex justify-content-center ">
    <div class="gambar-loading align-self-center">
        <img src="<?=base_url('assets/Backend/')?>assets/img/loading.gif" class="img-fluid">
        <p class="align-items-center mt-1 font-weight-bold text-white ml-0">Mohon Tunggu.....</p>
    </div>
</div>
<div class="bulet-besar"></div>

<!-- CONTAINER UTAMA -->

    <div class="box-login d-flex justify-content-between">
        <div class="content-left">
            <div class="bulat-sedang"></div>
            <div class="buku-tamu">
                <h4>Buku Tamu Digital</h4>
            </div>
            <div class="login-title">
                <h2>Selamat Datang</h2>
                <h1>DI PERPUSTAKAAN SMP NEGERI 1 CIGOMBONG</h1>
                <p>Silahkan ketikan / scen kode anggota anda</p>
            </div>
            <div class="logo-sekolah text-center">
                <img src="<?=base_url('assets/Backend/')?>assets/img/smpn1cigombong.png" alt="">
            </div>
            <div class="form-login text-center">
                <input type="text" name="login" id="loginUser" autocomplete="off"  placeholder="Scen Card">
            </div>
        </div>
        <div class="garis-tengah">
            <div class="bulet-kecil"></div>
        </div>
        <div class="content-right">
            <div class="bulat-agak-sedang"></div>

            <div class="buku-terbaru">
                <h4>Koleksi Terbaru</h4>
            </div>
            <div class="owl-carousel">
                <div> <img src="https://placeimg.com/800/1000/arch" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/animals" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/people" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/tech" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/any" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/any" alt=""> </div>
                <div> <img src="https://placeimg.com/800/1000/any" alt=""> </div>
            </div>
        </div>

    </div>



<!-- modal tambah Data-->
<div class="modal fade " id="modalUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalTambahBukuLabel" aria-hidden="true"> 
    <!-- modal dialog -->
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <!-- modal hedader -->
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tujuan Kunjuang Perpustakaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <!-- end modal header -->
            <div class="modal-body text-center ">
                <div class="user-data">

                </div>
                <form class="form-buku-tamu">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="baca" class="labelBukuTamu">
                            <img src="<?=base_url('assets/Backend')?>/assets/img/icon/check.png" alt="">
                            <h1>Membaca</h1>
                        </label>
                        <input type="checkbox"  name="baca" id="baca" value="1">
                        <label for="pinjam" class="labelBukuTamu">
                            <img src="<?=base_url('assets/Backend')?>/assets/img/icon/check.png" alt="">
                            <h1>Peminjaman Buku</h1>
                        </label>
                        <input type="checkbox"  name="pinjam" id="pinjam" value="1">
                        <label for="kembali" class="labelBukuTamu">
                            <img src="<?=base_url('assets/Backend')?>/assets/img/icon/check.png" alt="">
                            <h1>Pengembalian Buku</h1>
                        </label>
                        <input type="checkbox"  name="kembali" id="kembali" value="1">
                    </div>
                    <button type="submit">Kirim</button>
                </form>
            </div>
        </div>
        <!-- end modal  -->

    </div>
    <!-- end modal dialog -->
</div>
<!-- end modal data -->
    

<!-- jquer -->
<script src="<?=base_url('assets/Backend/')?>assets/js/jquery-3.5.1.min.js"></script>
<!-- owlCarosel -->
<script src="<?=base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/src/js/owl.carousel.js"></script>
<script src="<?=base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/src/js/owl.autoplay.js"></script>
<!-- bootrap -->
<script src="<?=base_url('assets/Backend/')?>assets/js/bootstrap.min.js"></script>
<!-- sweet alret -->
<script src="<?=base_url('assets/Backend/')?>assets/js/sweetalert2.all.js"></script>
<script src="<?=base_url()?>assets/DataTables/datatables.min.js"></script>
<!-- cart js -->
<!-- cart js -->
<!-- jquery validation -->
<script src="<?=base_url()?>assets/jquery-validation/dist/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<!-- main javascrip -->
<script src="<?= base_url('assets/Backend/')?>node_modules/chart.js/dist/Chart.js"></script>
<script src="<?=base_url('assets/Backend/')?>assets/js/script.js"></script>
</body>
</html>