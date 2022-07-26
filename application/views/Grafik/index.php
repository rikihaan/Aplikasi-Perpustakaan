<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <!-- bostrap csss -->
    <link rel="stylesheet" href="<?= base_url('assets/Backend/')?>assets/css/bootstrap.min.css">
    <!-- owlCarose -->
    <link rel="stylesheet" href="<?= base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <!-- cart-js -->
    <link rel="stylesheet" href="<?= base_url('assets/Backend/')?>node_modules/chart.js/dist/Chart.css">
    <link rel="stylesheet" href="<?= base_url('assets/Backend/')?>assets/scss/grafik.css">
</head>

<body>
<input type="hidden" class="url" value="<?=base_url()?>">
<input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
<div class="loading d-flex justify-content-center ">
    <div class="gambar-loading align-self-center">
        <img src="<?= base_url('assets/Backend/')?>assets/img/loading.gif" class="img-fluid">
        <p class="align-items-center mt-1 font-weight-bold text-white ml-0">Mohon Tunggu.....</p>
    </div>
</div>
<div class="bulet-besar"></div>

<!-- CONTAINER UTAMA -->

    <div class="box-grafik d-flex justify-content-between">
        <div class="content-left">
            <div class="bulat-sedang"></div>
            <div class="info-hariIni">
                <h4>INFO HARI INI</h4>
            </div>
            <div class="logo-sekolah text-center">
                <img src="<?= base_url('assets/Backend/')?>assets/img/smpn1cigombong.png" alt="">
            </div>
            <hr>
            <div class="box-informasi d-flex flex-column">
                <div class="informasi d-flex flex-column align-items-center">
                    <div class="judul-informasi">
                        <h2>Baca</h2>
                    </div>
                    <div class="informasiAngka d-flex justify-content-center align-items-center">
                        200
                    </div>
                </div>
                <div class="informasi d-flex flex-column align-items-center">
                    <div class="judul-informasi">
                        <h2>Peminjaman</h2>
                    </div>
                    <div class="informasiAngka d-flex justify-content-center align-items-center">
                        200
                    </div>
                </div>
                <div class="informasi d-flex flex-column align-items-center">
                    <div class="judul-informasi">
                        <h2>Pengembalian</h2>
                    </div>
                    <div class="informasiAngka d-flex justify-content-center align-items-center">
                        200
                    </div>
                </div>
               
            </div>
        </div>

        <div class="garis-tengah">
            <div class="bulet-kecil"></div>
        </div>

        <div class="content-right">
            <div class="bulat-agak-sedang"></div>

            <div class="judul-Grafix">
                <h4>DATA STATISTIK PERPUSTAKAAN</h4>
                <h4>SMP NEGERI 1 Cigmbong</h4>
            </div>
            <div class="row">
                <div class="col-6">
                    <h6 class="mt-4 text-primary">Data Pengunjung</h6>
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col-6">
                    <h6 class="mt-4 text-primary">Data Pengunjung Per Kelas</h6>
                    <canvas id="myChartKunjungan"></canvas>
                </div>
            </div>
            <div class="row">
            <div class="col">
                    <h6 class="mt-4 text-primary">Data Peminatan Buku</h6>
                    <canvas id="myChartPeminatan"></canvas>
                </div>
            </div>
        </div>

    </div>



<!-- jquer -->
<script src="<?= base_url('assets/Backend/')?>assets/js/jquery-3.5.1.min.js"></script>
<!-- owlCarosel -->
<script src="<?= base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/src/js/owl.carousel.js"></script>
<script src="<?= base_url('assets/Backend/')?>assets/OwlCarousel2-2.3.4/src/js/owl.autoplay.js"></script>
<!-- jquery validation -->
<script src="<?=base_url()?>assets/jquery-validation/dist/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<!-- bootrap -->
<script src="<?= base_url('assets/Backend/')?>assets/js/bootstrap.min.js"></script>
<!-- data tables -->
<script src="<?=base_url()?>assets/DataTables/datatables.min.js"></script>
<!-- sweet alret -->
<script src="<?= base_url('assets/Backend/')?>assets/js/sweetalert2.all.js"></script>
<!-- cart js -->
<script src="<?= base_url('assets/Backend/')?>node_modules/chart.js/dist/Chart.js"></script>
<!-- main javascrip -->
<script src="<?= base_url('assets/Backend/')?>assets/js/script.js"></script>
</body>
</html>