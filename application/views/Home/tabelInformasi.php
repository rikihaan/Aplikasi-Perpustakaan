<!-- tabel pendaftaran -->
<section class="tabel-pedaftaran mt-5">
  <div class="container">
    <div class="row">
      <div class="col-9 judul">
        <h3>Data Pendaftaran</h3>
        <p>Informasi dibawah ini adalah realtime jika terjadi kendala internet silahkan refresh halaman atau tekan F5
          pada Keyboard
        </p>

      </div>
    </div>

    <div class="row ikon-info mb-3">
      <div class="col-3 col-md-2 text-center">
        <img src="<?= base_url('assets/HomeAssets/img/logo/1.svg') ?>" width="15">
        Proses
      </div>

      <div class="col-3 col-md-2 text-center">
        <img src="<?= base_url('assets/HomeAssets/img/logo/2.svg') ?>" width="15">
        Terverifikasi
      </div>

      <div class="col-3 col-md-2 text-center">
        <img src="<?= base_url('assets/HomeAssets/img/logo/3.svg') ?>" width="15">
        Cabut Berkas
      </div>
      <div class="col-3 col-md-2 text-center">
        <img src="<?= base_url('assets/HomeAssets/img/logo/4.svg') ?>" width="15">
        Lulus
      </div>
      <div class="col-3 col-md-2 text-center">
        <img src="<?= base_url('assets/HomeAssets/img/logo/5.svg') ?>" width="15">
        Tidak Lulus
      </div>
    </div>

    <div class="row">

      <div class="col-12 col-sm-12 col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="perJalur-tab" data-toggle="tab" href="#perJalur" role="tab" aria-controls="perJalur" aria-selected="true">Berdaasarkan Jalur</a>
          </li>

        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <table id="table" class="table table-hover table-sm">
              <thead>
                <tr>
                  <td>No</td>
                  <td>ID</td>
                  <td>Nama</td>
                  <td>Score Jarak</td>
                  <td>Score Nilai</td>
                  <td>Jalur</td>
                  <td>Status</td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="tab-pane fade show " id="perJalur" role="tabpane2" aria-labelledby="perJalur-tab">
            <input type="hidden" class="url" value="<?= base_url(); ?>">
            <div class="form-group">
              <select name="SelectJalur" id="SelectJalur" class="form-control">
                <option value="1">-----Pilih Jalur</option>
                <?php foreach ($jalurPpdb as $j) : ?>
                  <option value="<?= $j['id'] ?>"><?= $j['ppdb'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <table id="tablePerjalur" class="table table-hover tablePerjalur table-sm">
              <thead>
                <tr>
                  <td>No</td>
                  <td>ID</td>
                  <td>Nama</td>
                  <td>Score Jarak</td>
                  <td>Score Nilai</td>
                  <td>Jalur</td>
                  <td>Status</td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>


        </div>
      </div>
    </div>
  </div>
</section>
<!-- batas tabel pendaftaran -->