if(isset($_FILES["importDataBuku"]["name"]))
        {
            $path = $_FILES["importDataBuku"]["tmp_name"];
            // $namafile =$_FILES['importDataBuku']['size'];
            // echo $namafile; die;
            require(APPPATH . 'PHPExcel/Classes/PHPExcel.php');
            require(APPPATH . 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                if($this->buku->cekKodeBuku($worksheet->getCellByColumnAndRow(1))>0){
                  continue;
                }
                for($row=2; $row<=$highestRow; $row++)
                {   
                    $kategoriBuku = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $kodeBuku= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $judul= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $tahun= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $pengarang= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jmlhHalaman= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $qty= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tglRegister= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $tglUpdate= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $statusPeminjaman= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $statusBuku= $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $barcodeStatus= $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $sampul= $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                      $data[] = array(
                          'id'=>null,
                          'idKategori'=> $kategoriBuku,
                          'kodeBuku'  => $kodeBuku,
                          'judul'     => $judul,
                          'tahun'     => $tahun,
                          'pengarang' => $pengarang,
                          'jmlhHalaman' =>$jmlhHalaman,
                          'qty'=>$qty,
                          'tglRegister'=>$tglRegister,
                          'tglUpdate'=>$tglUpdate,
                          'statusPeminjaman'=>$statusPeminjaman,
                          'statusBuku'=> $statusBuku,
                          'barcodeStatus'=>$barcodeStatus,
                          'sampul'=>$sampul,
                      ); 
                  }

                }
               
                $this->buku->insertimportDataBuku($data); 

        }                

    }






    $fileLocation=$_FILES['importDataBuku']['tmp_name'];
      // baca file Excel
      New PHPExcel;
      $objPHPExcel= PHPExcel_IOFactory::load($fileLocation);
      // ambil seet Aktif
      $sheet= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

      // melakukan perulanagn data dari excel
      foreach ($sheet as $key => $data) {
        // skip bari satu karena data judul
        if($key==1){
          continue;
        }

        $kodeBuku=$this->buku->cekKodeBuku($data['B']);
        if($data['B']== $kodeBuku['kodeBuku']){
          continue;
        }

        $data[] = array(
          'id'=>null,
          'idKategori'=> $data['A'],
          'kodeBuku'  => $data['B'],
          'judul'     => $data['C'],
          'tahun'     => $data['D'],
          'pengarang' => $data['E'],
          'jmlhHalaman' =>$data['F'],
          'qty'=>$data['G'],
          'tglRegister'=>$data['H'],
          'tglUpdate'=>$data['I'],
          'statusPeminjaman'=>$data['J'],
          'statusBuku'=> $data['K'],
          'barcodeStatus'=>$data['L'],
          'sampul'=>$data['M'],
      ); 
      $this->buku->insertimportDataBuku($data); 
      }

      echo "data Masuk";