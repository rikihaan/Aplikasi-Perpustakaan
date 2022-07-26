<div class="content">
        <input type="hidden" name="url" class="url" value="<?=base_url();?>">
        <input type="hidden" name="user" class="user" value="<?=$user['id'];?>">
        <div class="header d-flex flex-row justify-content-between">
            <div class="jmlpengunjung">
                <h4>Jumlah Pengunjung</h4>
                <div class="jumlahp"></div>
            </div>
            <div class="logo-sekolah">
                <h4>Perpustakaan</h4>
                <h6>SMP NEGERI 1 CIGOMBONG</h6>
            </div>
            <div class="tanggal-box ">
                <div class="tanggal">
                    20 September 2021
                </div>
                <div class="jam">
                    08:09:09
                </div>
            </div>
        </div>
        <div class="main d-flex flex-row justify-content-between">
            <!-- main left -->
           <div class="main-left d-flex flex-row">

            <button class="btn btn-success tombolPrintBarcode"><i class="fa fas fa-print"> Print Barcode</i></button>
              <div class="barcode-box d-flex flex-wrap flex-row justify-content-between" id="printBarcode">
                <?php for($i=1; $i <= 40; $i++) { ?>
                    <div class="barcode">
                        <?php
                        $redColor = [255, 0, 0];

                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('085863330311', $generator::TYPE_CODE_128,2,50)) . '">';
                        // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        // echo $generator->getBarcode('085863330311',$generator::TYPE_CODE_128,1.5,40);
                        ?>
                        <p>085863330311</p>
                    </div>
                <?php }?>
              </div>
           </div>
        </div>

    </div>