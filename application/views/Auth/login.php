<!-- CONTAINER UTAMA -->
<input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
<div class="container-login d-flex justify-content-between flex-wrap">
    <?= $this->session->flashdata('message') ?>
    <div class="box-login">
        <div class="login-title text-center">
            <h2>Selamat Datang, Silahkan</h2>
            <h1>Login</h1>
        </div>
        <div class="logo-sekolah text-center">
            <img src="<?=base_url()?>assets/Backend/assets/img/smpn1cigombong.png" alt="">
        </div>

        <form action="<?=base_url('Auth')?>" method="post">
            <div class="form-login text-center">
                <input type="text" name="login" id="login"  placeholder="Scen Card">
                <?= form_error('login', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </form>


    </div>
</div>