<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Dokumen</title>
</head>

<style>

 
    .barcode{
        float: left;
        /* border: 1px solid red; */
        width: 170px;
        margin-left:19px;
    }

    .barcode p{
        text-align: right;
        margin-top: -1px;
    }
</style>
<body>



<div class="barcode-box">
    <?php foreach($code as $users) { ?>
        <div class="barcode">
            <?php
            $redColor = [255, 0, 0];

            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($users['Kodebuku'], $generator::TYPE_CODE_128,2,50)) . '"><br>'.$users['Kodebuku'].'';
            // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            // echo $generator->getBarcode('085863330311',$generator::TYPE_CODE_128,1.5,40);
            ?>
        </div>
        <?php }?>
        <div style="clear: both;"></div>
    </div>
    <?php
    ?>
</body>
</html>