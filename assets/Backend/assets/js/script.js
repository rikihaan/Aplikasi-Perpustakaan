$(document).ready(function(){
  // $('.loading').css('top', '0');
  // $('.gambar-loading').css('opacity', '1');
  
  var url = $('.url').val()
  var uriSegmen=$('.uriSegmen').val();
  if(uriSegmen=='grafik'){
    // kunjungan()
    statistik()
  }else if(uriSegmen=='pengunjung'){
    perpusCarousel()
  }
  
  // loadd data ketegori bukua
  loadKategoriBuku()
  loadKategorikelas()
  cekSessionAnggotaPengembalianBuku();
  cekSessionAnggotaPengembalianBukuPaket();
  function statistik() {
    setTimeout(function() {
      kunjungan()
      KunjunganPerkelas()
      statistik();
    }, 10000);
    }
  

// ========================Kumpulan function==================================
 


// ========================Akhir Kumpulan Function============================






// =================================================Java sript Buku================
    // TABEL BUKU YANG SUDAH DI BARCODE
    var tabelBukuBarcode = $('#tabelBukuBarcode').DataTable({
      "scrollY": "270px",
      "scrollCollapse": true,
      "paging": true,
      "searching": true,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": url + 'Buku/getdataBukuAllBarcode',
        "type": "POST"
      },

      "columnDefs": [{

          "targets": [4,5,-1],
          "orderable": false
        }

      ]
    });


    // get data Buku====================================
    
    var tabelBuku = $('#tabelBuku').DataTable({
      "scrollY": "270px",
      "scrollCollapse": true,
      "paging": true,
      "searching": true,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": url + 'Buku/GetDataBukuAll',
        "type": "POST"
      },

      "columnDefs": [{

          "targets": [4,5,-1],
          "orderable": false
        }

      ]
    });

    
    // end get data buku============================================

   

    // select data buku untuk cetak bacode
    $('.table-custum').on('click','.check-code',function(){
      let code= $(this).val();
      let user= $('.user').val();
      $.ajax({
        url:url+'Buku/simpanUntukCetak',
        method:'post',
        // dataType:'json',
        data:{
          code:code,
          user:user
        },
        biforeSend:function(){
            loadingStart()
        },
        success:function(respon){

          if(respon == 'ok'){
            console.log(jumlahCetak(code));
          }


        }
      })
    }) 

    // function jumlah cetak
    function jumlahCetak(code){
      // let code= $(this).val();
      let user= $('.user').val();
      let url= $('.url').val();
      $.ajax({
        url:url+'Buku/jumlahCetak',
        method:'post',
        // dataType:'json',
        data:{
          code:code,
          user:user
        },
        success:function(jml){

          return jml

        }
      })
    }

    // exsekusi print javascrip 
    function printData()
      {
      
        window.print();
       
      }


      // PRINT BARCODE SATUAN
      $('.table-custum').on('click','.tombolPrintBarcode',function(){
          // $('.loading').css('top', '0');
          // $('.gambar-loading').css('opacity', '1');
          let id = $(this).data('id');
          $.ajax({
            type: 'POST',
            url: url+'Buku/printBarcodeSatuan',
            data: {id:id},
            dataType:'json',
            success: function (data) {
            $('.loading').css('top', '100%');
            $('.gambar-loading').css('opacity', '0');
            }
          })
        // printData();
      })
     
    // end print barcode satuan

    // copy input buku
    $('.table-custum').on('click','.tombolCopyBuku',function(){
      $('.loading').css('top', '0');
      $('.gambar-loading').css('opacity', '1');
      $('.modalCopyBuku .modal-body').html('');
      $('.modalCopyBuku .modal-title').html('');
      $('.modalCopyBuku .info').html('');


      let id = $(this).data('id');
      alert(id)
      $.ajax({
        type: 'POST',
        url: url+'Buku/copyBuku',
        data: {id:id},
        dataType:'json',
        success: function (data) {
          $('.modalCopyBuku .modal-title').append(`Copy Data Buku `+data.kodeBuku );
          $('.modalCopyBuku .modal-body').append(`
          <table class="table table-sm">
              <tr>
                <th>Judul</th>
                <td>:</td>
                <td>`+data.judul+`</td>

                <th>Klasifikasi Khusus</th>
                <td>:</td>
                <td>`+data.idKategori+`</td>
              </tr>
              <tr>
                <th>Klasifikasi Umum</th>
                <td>:</td>
                <td>`+data.kodeSpesifikasi+`</td>
              </tr>
          </table>
          <input type="hidden" class="id" value="`+data.id+`">
          <label>Masukan Jumlah Copy</label>
          <input type="text" class=" form-control jlm" required>
          <button class="btn btn-success mt-3 btn-copy-buku"><i class="fas fa-copy"></i> Copy Buku</button>
          `);
          $('.modalCopyBuku .info').append('');
          $('#modalCopyBuku').modal('show')
        
        $('.loading').css('top', '100%');
        $('.gambar-loading').css('opacity', '0');
        }
      })
    // printData();
    })

    // tombol proses copy buku
    $('.modalCopyBuku').on('click','.btn-copy-buku',function(){
        let id = $('.modalCopyBuku .id').val();
        let jml = $('.modalCopyBuku .jlm').val();
        $.ajax({
          url:url+'Buku/copyDataBuku',
          method:'post',
          data:{id:id,jml:jml},
          // dataType:'json',
          success:function(){
            Swal.fire({
              position: 'top',
              icon: 'success',
              title: 'Data Berhasil Tercopy',
              showConfirmButton: false,
              timer: 1500,
            });
            tabelBuku.ajax.reload();
              
            }
        })
    })


    // import excel data buku
        $('#uploade').on('click',function(e){
          e.preventDefault();
          $('.loading').css('top', '0');
          $('.gambar-loading').css('opacity', '1');
          const fileupload = $('#UploadDataBuku').prop('files')[0];
          const url =$('.url').val()
          if(fileupload!=""){
            let formData = new FormData();
            formData.append('importDataBuku', fileupload);
            $('.modalBerhasilUpload .modal-title').html('')
            $('.informasiUploadBuku tbody').html('')
              // ajax
              $.ajax({
                type: 'POST',
                url: url+'Buku/importFileBuku',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType:'json',
                success: function (data) {
                  console.log(data)
                  if(data.duplikast ==0){
                    Swal.fire({
                      position: 'top',
                      icon: 'success',
                      title: 'Upload data Berhasil',
                      text: data.masuk+ ` Berhasil d upload dan ada`,
                      showConfirmButton: true,
                      // timer: 1500,
                    });
                  }
                  else{

                    $('.modalBerhasilUpload .modal-title').append(`
                    <p class="text-success">`+data.masuk+` Berhasil Di Upload</p>
                    <p class="text-danger">Data Duplikat berjumlah `+data.duplikast+` perbaiki data sebelum di upload</p>
                    `)
                    let books=data.buku;
                    let no=1;
                    for (let index = 0; index < books.length; index++) {
                    
                     $('.informasiUploadBuku tbody').append(`
                         <tr>
                             <td>`+no+++`</td>
                             <td>`+books[index]['kodeBuku']+`</td>
                             <td>`+books[index]['judul']+`</td>
                             <td>`+books[index]['spek']+`</td>
                         </tr>
                     `)
                    }
                   
                      
                  
                    $('#modalBerhasilUpload').modal('show');
                  }
                  $('#modalImportBuku').modal('hide')
                  $('.form-data')[0].reset();
                  tabelBuku.ajax.reload();
                  $('.loading').css('top', '100%');
                  $('.gambar-loading').css('opacity', '0');
                   
                },
                error: function (error) {
                    alert(error);
                }
            });
            // end ajax
           
          }
        })
    // end import excel data buku

    //  load data kategori buku
        function loadKategoriBuku(){
          $('.kategoriBuku').html('')
          let url = $('.url').val();
          $.ajax({
            url:url + 'Buku/KetegoriAll',
            method:'post',
            dataType:'json',
            success:function(data){
              $('.kategoriBuku').append(`<option value="">-----PIlih Ketegori Buku</option>`);
              $.each(data, function (key, value) {
               $('.kategoriBuku').append(`<option value="`+ value.idKategori + `">`+value.idKategori+` - ` + value.kategori + `</option>`);
              });
            }
          })
        }
    //  end load data kategori buku

    // script tambah data buku=======================================================================================
        //  klik tombol tambah data load kategori buku
        $('#tombolTambahDataBuku').on('click',function(){
          loadKategoriBuku();
        })
        // validasi dulu dengan jquery validation dan sweet aler
        $('.form-buku').validate({
          // rules
          rules:{
              'judul':{
                required:true
              },
              'tahun':{
                required:true,
                number:true,
                maxlength:4,
                minlength:4
              },
              'spesifiksi':{
                required:true,
                number:true,
                maxlength:3,
                minlength:3
              },
              'pengarang':{
                required:true
              },
              'jumlahHalaman':{
                required:true

              }
            },
            // end rules

            // message
            messages:{
              'judul':'judul harus di isi',
              
              'tahun':{
                required:'tahun harus di isi',
                number:'Isi dengan nomber',
                maxlength:'maxsimal 4 digit',
                minlength:'minimal 4 diigit'
              },
              'spesifiksi':{
                required:'sepesifikasi harus di isi',
                number:'Isi dengan nomber',
                maxlength:'maxsimal 3 digit',
                minlength:'minimal 3 diigit'
              },

              'pengarang':{
                required:'pengarang harus di isi'
              },
              'jumlahHalaman':{
                required:'jumlah halaman masih kosong'

              }
            },
            // end messages

            // submit hendler
            submitHandler:function(form){
              Swal.fire({
                  title:'Yakin ?',
                  type:'success',
                  showCancelButton:true,
                  confirmButtonColor:'#3085d6',
                  cancelButtonColor:'#d33',
                  confirmButtonText:'Yes'

              }).then((result)=>{
                if(result.value){
                  simpanDataBuku();
                }
                else{
                  return false;
                }
              })
              // end sweet alert
            }
            // end sumbit henler
        })
        // end validation data

          function simpanDataBuku(){
          let dataForm= $('.form-buku').serialize();
          let url =$('.url').val();
          $.ajax({
              url:url+'Buku/SimpanBuku',
              method:'post',
              data:dataForm,
              // dataType:'json',
              success:function(){
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Data Berhasil Tersimpan',
                    showConfirmButton: false,
                    timer: 1500,
                  });

                  $('.form-buku')[0].reset();
                  tabelBuku.ajax.reload();
                  
                }
            })
          }
    // end script tambah data buku==========================================================

        // script edit buku=====================================================================
            $('.table-custum').on('click','.tombolEditBuku',function(){
                $('.loading').css('top', '0')
                $('.gambar-loading').css('opacity', '1')
                loadKategoriBuku();
                $('#modalEditBuku').modal('show');
                $('.judul').val('');
                  $('.id').val('');
                  $('.tahun').val('');
                  $('.pengarang').val('');
                  $('.jumlahHalaman').val('');
                  $('.judul').val('');
                  $('.kategoriBuku').val('');
                  $('.spesifiksi').val('');
                let id=$(this).data('id');
                alert(id)
                let url = $('.url').val();
                $.ajax({
                  url:url+'Buku/getDatabukuById',
                  dataType:'json',
                  data:{
                    id:id
                  },
                  method:'post',
                  success:function(respon){
                    $('.judul').val(respon.judul);
                    $('.id').val(respon.id);
                    $('.tahun').val(respon.tahun);
                    $('.pengarang').val(respon.pengarang);
                    $('.jumlahHalaman').val(respon.jmlhHalaman);
                    $('.judul').val(respon.judul);
                    $('.kategoriBuku').val(respon.idKategori);
                    $('.spesifiksi').val(respon.kodeSpesifikasi);
                    $('.loading').css('top', '100%')
                    $('.gambar-loading').css('opacity', '0')
                  }
              });
              
            });
        // end script edit buku

        //  proses edit data buku
            function prosesEditBuku(){
              let dataForm= $('.formEditBuku').serialize();
              let url =$('.url').val();
              $.ajax({
                  url:url+'Buku/editDataBuku',
                  method:'post',
                  data:dataForm,
                  // dataType:'json',
                  success:function(){
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: 'Data Berhasil Diedit',
                        showConfirmButton: false,
                        timer: 1500,
                      });
                      $('.formEditBuku')[0].reset();
                      tabelBuku.ajax.reload();
                      
                    }
                })
              }
        //  end proses edit data buku

        // validasi edit data buku
            $('.formEditBuku').validate({
              // rules
              rules:{
                  'judul':{
                    required:true
                  },
                  'tahun':{
                    required:true,
                    number:true,
                    maxlength:4,
                    minlength:4
                  },
                  'spesifiksi':{
                    required:true,
                    number:true,
                    maxlength:3,
                    minlength:3
                  },
                  'pengarang':{
                    required:true
                  },
                  'jumlahHalaman':{
                    required:true

                  }
                },
                // end rules

                // message
                messages:{
                  'judul':{ required:'judul harus di isi',
                  },

                  'spesifiksi':{
                    required:'sepesifikasi harus di isi',
                    number:'Isi dengan nomber',
                    maxlength:'maxsimal 3 digit',
                    minlength:'minimal 3 diigit'
                  },
                  
                  'tahun':{
                    required:'tahun harus di isi',
                    number:'Isi dengan number',
                    maxlength:'maxsimal 4 digit',
                    minlength:'minimal 4 diigit'
                  },

                  'pengarang':{
                    required:'pengarang harus di isi'
                  },
                  'jumlahHalaman':{
                    required:'jumlah halaman masih kosong'

                  }

                },
                // end messages

                // submit hendler
                submitHandler:function(){
                  Swal.fire({
                      title:'Yakin Edit Data ?',
                      icon:'success',
                      showCancelButton:true,
                      confirmButtonColor:'#3085d6',
                      cancelButtonColor:'#d33',
                      confirmButtonText:'Yes'

                  }).then((result)=>{
                    if(result.value){
                      prosesEditBuku();
                    }
                    else{
                      return false;
                    }
                  })
                  // end sweet alert
                }
                // end sumbit henler
            })
      // end validasi edit data buku


      // scrip hapus data buku
          // saat tombol hapus di klik jalankan confirmasi sweet aler
          $('.table-custum').on('click','.tombolHapusBuku',function(){
              let id = $(this).data('id');
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Data Buku",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!, Hapus Saja'
              }).then((result) => {
                if (result.value) {
                 hapusDataBuku(id);
                 tabelBuku.ajax.reload();
                }
              })

          });

          // function hapus data buku
          function hapusDataBuku(id){
            let url=$('.url').val();
            $.ajax({
              url:url+'Buku/HapusBuku',
              data:{
                id:id
              },
              method:'post',
              success:function(){
                  Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Hapus Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500,
                  });

              }


            })

          }
      // end scrip hapus data buku
      
// =======================================Akhir dari java scrip buku==============  
      
      
 


// ============================================================Java sript anggota================

  // get data anggota data tables====================================
  var url = $('.url').val()
	var tabelAnggota = $('#anggota').DataTable({
		"scrollY": "350px",
		"scrollCollapse": true,
		"paging": true,
		"searching": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": url + 'Anggota/getDataAnggotaAll',
			"type": "POST"
		},

		"columnDefs": [{

				"targets": [4,-1],
				"orderable": false
			}

		]
	});
  // end get data anggota data tables============================================

   //  load data kelas
   function loadKategorikelas(){
    $('.dataKelas').html('')
    let url = $('.url').val();
    $.ajax({
      url:url + 'Anggota/GetdataKelas',
      method:'post',
      dataType:'json',
      success:function(data){
        $('.dataKelas').append(`<option value="">-----PIlih Kelas</option>`);
        $.each(data, function (key, value) {
         $('.dataKelas').append(`<option value="`+ value.kodeKelas + `">` + value.kelas + `</option>`);
        });
      }
    })
  }
//  end load data kelas

// validasi form tambah anggota
$('.formAnggota').validate({
  // rules
  rules:{
      'kelas':{
        required:true
      },
      'nama':{
        required:true
      },
      'nis':{
        required:true
      },
      'nisn':{
        required:true

      },
      'alamat':{
        required:true
      }
    },
    // end rules

    // message
    messages:{
      'kelas':'kelas belum dipilih',
      
      'nama':{
        required:'nama harus di isi'
      },

      'nis':{
        required:'nis harus di isi'
      },
      'nisn':{
        required:' nisn masih kosong'

      }
      ,
      'alamat':{
        required:' alamat masih kosong'

      }
    },
    // end messages

    // submit hendler
    submitHandler:function(form){
      Swal.fire({
          title:'Yakin ?',
          icon:'success',
          showCancelButton:true,
          confirmButtonColor:'#3085d6',
          cancelButtonColor:'#d33',
          confirmButtonText:'Yes'

      }).then((result)=>{
        if(result.value){
          simpanDataAnggota();
        }
        else{
          return false;
        }
      })
      // end sweet alert
    }
    // end sumbit henler
})

// end form valisasi tambah anggota

//  edit anggota
$('.table-custum').on('click','.tombolEditAnggota',function(){
  $('.loading').css('top', '0')
  $('.gambar-loading').css('opacity', '1')
  $('#modalEditAnggota').modal('show');
    $('.dataKelas').val('');
    $('.id').val('');
    $('.nama').val('');
    $('.nis').val('');
    $('.nisn').val('');
    $('.alamat').append('');
  let id=$(this).data('id');
  let url = $('.url').val();
  $.ajax({
    url:url+'Anggota/getDataAnggotaById',
    dataType:'json',
    data:{
      id:id
    },
    method:'post',
    success:function(respon){
      console.log(respon)
    $('.dataKelas').val(respon.kodeKelas);
    $('.id').val(respon.id);
    $('.nama').val(respon.nama);
    $('.nis').val(respon.nis);
    $('.nisn').val(respon.nisn);
    $('.alamat').val(respon.alamat);
    $('.loading').css('top', '100%')
  $('.gambar-loading').css('opacity', '0  ')
    }
});

});
// end edit anggoota

// validasi proses edit anngota
$('.formEditAnggota').validate({
  // rules
  rules:{
      'kelas':{
        required:true
      },
      'nama':{
        required:true
      },
      'nis':{
        required:true
      },
      'nisn':{
        required:true

      },
      'alamat':{
        required:true
      }
    },
    // end rules

    // message
    messages:{
      'kelas':'kelas belum dipilih',
      
      'nama':{
        required:'nama harus di isi'
      },

      'nis':{
        required:'nis harus di isi'
      },
      'nisn':{
        required:' nisn masih kosong'

      }
      ,
      'alamat':{
        required:' alamat masih kosong'

      }
    },
    // end messages

    // submit hendler
    submitHandler:function(form){
      Swal.fire({
          title:'Yakin ?',
          icon:'success',
          showCancelButton:true,
          confirmButtonColor:'#3085d6',
          cancelButtonColor:'#d33',
          confirmButtonText:'Yes'

      }).then((result)=>{
        if(result.value){
          prosesEditAnggota();
        }
        else{
          return false;
        }
      })
      // end sweet alert
    }
    // end sumbit henler
})

// function proses edit anggota
    function prosesEditAnggota(){
      let dataForm= $('.formEditAnggota').serialize();
      let url =$('.url').val();
      $.ajax({
          url:url+'Anggota/editDataAnggota',
          method:'post',
          data:dataForm,
          // dataType:'json',
          success:function(){
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Data Berhasil Diedit',
                showConfirmButton: false,
                timer: 1500,
              });
              tabelAnggota.ajax.reload();
              
            }
        })
      }

// end function proses edit anggota

// tombol add anggota
 $('#tombolTambahDataAnggota').on('click',function(){
  $('.formAnggota')[0].reset()
 })
// end tombol add anggota

// function simpan anggota
function simpanDataAnggota(){
  let dataForm= $('.formAnggota').serialize();
  let url =$('.url').val();
  $.ajax({
      url:url+'Anggota/SimpanAnggota',
      method:'post',
      data:dataForm,
      // dataType:'json',
      success:function(){
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Data Berhasil Tersimpan',
            showConfirmButton: false,
            timer: 1500,
          });

          $('.formAnggota')[0].reset();
          tabelAnggota.ajax.reload();
          
        }
    })
  }
  // end function simpan anggota

  // function hapus data anggota

      // tombol hapus data anggota
      $('.table-custum').on('click','.tombolHapusAnggota',function(){
        let id = $(this).data('id');
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Ingin Menghapus Data Anggota",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, Hapus Saja'
        }).then((result) => {
          if (result.value) {
            hapusDataAnggota(id);
            tabelAnggota.ajax.reload();
          }
        })

    });


      function hapusDataAnggota(id){
        let url=$('.url').val();
        $.ajax({
          url:url+'Anggota/HapusAnggota',
          data:{
            id:id
          },
          method:'post',
          success:function(){
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Hapus Data Berhasil',
                showConfirmButton: false,
                timer: 1500,
              });

          }


        })

      }
  // end funtion hapus data anggota


   // import excel data Anggota
   $('#uploadeAnggota').on('click',function(e){
    e.preventDefault();
    $('.loading').css('top', '0');
    $('.gambar-loading').css('opacity', '1');
    const fileupload = $('#UploadDataAnggota').prop('files')[0];
    const url =$('.url').val()
    if(fileupload!=""){
      let formData = new FormData();
      formData.append('importDataAnggota', fileupload);
      $('.modalBerhasilUpload .modal-title').html('')
      $('.informasiUploadAnggota tbody').html('')
        // ajax
        $.ajax({
          type: 'POST',
          url: url+'Anggota/importFileAnggota',
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          dataType:'json',
          success: function (data) {
            if(data.duplikast ==0){
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Upload data Berhasil',
                text: data.masuk+ ` Berhasil di upload`,
                showConfirmButton: true,
               
              });
            }
            else{
              $('.modalBerhasilUpload .modal-title').append(`
              <p class="text-success">`+data.masuk+` Berhasil Di Upload</p>
              <p class="text-danger">Data Duplikat berjumlah : `+data.duplikast+`, Berhasil di update,</p>
              <p class="text-danger">Data NIS Kosong : `+data.nisKosong+` Isi Nis sebelum di upload,</p>
              <p class="text-danger">Data NISN Kosong : `+data.nisnKosong+` Isi Nisn sebelum di upload,</p>
              `)
              let books=data.update;
            
              let no=1;
              $.each(books, function (key, value){
                console.info(value)
                $('.informasiUploadAnggota tbody').append(`
                <tr>
                    <td>`+no+++`</td>
                    <td>`+value.nama+`</td>
                    <td>`+value['kelas']+`</td>
                    <td>`+value['nis']+`</td>
                    <td>`+value['nisn']+`</td>
                </tr>
            `)
              })

              $('#modalBerhasilUpload').modal('show');
            }
            $('#modalImportAnggota').modal('hide')
            $('.form-dataAnggota')[0].reset();
            tabelAnggota.ajax.reload();
            $('.loading').css('top', '100%');
            $('.gambar-loading').css('opacity', '0');
             
          },
          error: function (error) {
              alert(error);
              $('.loading').css('top', '100%');
              $('.gambar-loading').css('opacity', '0');
          }
      });
      // end ajax
     
    }
  })
  // end import excel data Anggota

  // tombol aktif non aktifkan anggota
      $('.table-custum').on('click','.aktifNonaktif',function(){
        let id = $(this).data('id');
        Swal.fire({
          title: 'Anda Yakin?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!'
        }).then((result) => {
          if (result.value) {
            aktifNonaktifAnggota(id);
            tabelAnggota.ajax.reload();
          }
        })

    });

    // function aktif nonaktifkan anggota
    function aktifNonaktifAnggota(id){
      $('.loading').css('top', '0');
      $('.gambar-loading').css('opacity', '1');
      let url=$('.url').val();
      $.ajax({
        url:url+'Anggota/aktifNonaktifAnggota',
        data:{
          id:id
        },
        method:'post',
        dataType:'json',
        success:function(data){
          if(data.pesan=='success'){
            Swal.fire({
              position: 'top',
              icon: 'success',
              title: 'Prubahan Data Berhasil',
              showConfirmButton: false,
              timer: 1200,
            });
            $('.loading').css('top', '100%');
            $('.gambar-loading').css('opacity', '0');
          }
          else{
            Swal.fire({
              position: 'top',
              icon: 'error',
              title: 'Prubahan Data Gagal',
              showConfirmButton: true,
            });
            $('.loading').css('top', '100%');
            $('.gambar-loading').css('opacity', '0');
          }

        }


      })
    }


  // =======================================Akhir dari java scrip anggota==========================



  // ==============================================Java Scrip User/Pengguna==========================
      // script ambil data user all untuk data tables
      var url = $('.url').val()
      var tabelUser = $('#userTable').DataTable({
        "scrollY": "270px",
        "scrollCollapse": true,
        "paging": true,
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": url + 'User/GetDataUserAll',
          "type": "POST"
        },

        "columnDefs": [{

            "targets": [3,-1],
            "orderable": false
          }

        ]
      });
      // end data tables

      // function untuk simpen data user
        function simpanDataUser(){
          let dataForm= $('.formUser').serialize();
          let url =$('.url').val();
          $.ajax({
              url:url+'User/SimpanUser',
              method:'post',
              data:dataForm,
              // dataType:'json',
              success:function(){
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Data Berhasil Tersimpan',
                    showConfirmButton: false,
                    timer: 1500,
                  });

                  $('.formUser')[0].reset();
                  tabelUser.ajax.reload();
                  
                }
            })
          }
       // end function untuk simpan data user

      //  tombol edit user
      $('.table-custum').on('click','.tombolEditUser',function(){
          $('.loading').css('top', '0')
          $('.gambar-loading').css('opacity', '1')
          $('#modalEditUser').modal('show');
            $('.dataRoles').val('');
            $('.id').val('');
            $('.nama').val('');
          let id=$(this).data('id');
          let url = $('.url').val();
          $.ajax({
            url:url+'User/getDataUserById',
            dataType:'json',
            data:{
              id:id
            },
            method:'post',
            success:function(respon){
            $('.nama').val(respon.name);
            $('.id').val(respon.id);
            $('.dataRoles').val(respon.role_id);
            }
        });
      
      });
      // end tombol edit user

      // tombol tambah data user
      $('#tombolTambahDataUser').on('click',function(){
        $('.formUser')[0].reset()
       })
      // end tombol tambah user

      // tombol Hapus User
      $('.table-custum').on('click','.tombolHapusUser',function(){
        let id = $(this).data('id');
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Ingin Menghapus Data User",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, Hapus Saja'
        }).then((result) => {
          if (result.value) {
            hapusDataUser(id);
            // tabelUser.ajax.reload();
          }
        })
    });
      // end hapus tombol User


      // function proses edit user pengguna
      function prosesEditUser(){
        let dataForm= $('.formEditUser').serialize();
        let url =$('.url').val();
        $.ajax({
            url:url+'User/editDataUser',
            method:'post',
            data:dataForm,
            // dataType:'json',
            success:function(){
              Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Data Berhasil Diedit',
                  showConfirmButton: false,
                  timer: 1500,
                });
                tabelUser.ajax.reload();
                
              }
          })
      }
      // end function proses edit user pengguna

      // validasi for tambah  user
      $('.formUser').validate({
        // rules
        rules:{
            'nama':{
              required:true
            },
            'roles':{
              required:true
            }
          },
          // end rules
      
          // message
          messages:{
            'nama':'nama Harus Diisi',
            
            'roles':{
              required:'roles belum dipilih'
            },
      
            
          },
          // end messages
      
          // submit hendler
          submitHandler:function(form){
            Swal.fire({
                title:'Yakin ?',
                icon:'success',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes'
      
            }).then((result)=>{
              if(result.value){
                simpanDataUser();
                tabelUser.ajax.reload();

              }
              else{
                return false;
              }
            })
            // end sweet alert
          }
          // end sumbit henler
      })
      // end validasi tambah  user


      // validasi edit form user
      $('.formEditUser').validate({
        // rules
        rules:{
            'nama':{
              required:true
            },
            'roles':{
              required:true
            }
          },
          // end rules
      
          // message
          messages:{
            'nama':'nama Harus Diisi',
            
            'roles':{
              required:'roles belum dipilih'
            },
      
            
          },
          // end messages
      
          // submit hendler
          submitHandler:function(form){
            Swal.fire({
                title:'Yakin ?',
                icon:'success',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes'
      
            }).then((result)=>{
              if(result.value){
                prosesEditUser();
                tabelUser.ajax.reload();

              }
              else{
                return false;
              }
            })
            // end sweet alert
          }
          // end sumbit henler
      })
      // end valiasi edit user


      // function hapus data user
      function hapusDataUser(id){
        let url=$('.url').val();
        $.ajax({
          url:url+'User/HapusUser',
          data:{
            id:id
          },
          method:'post',
          success:function(){
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Hapus Data Berhasil',
                showConfirmButton: false,
                timer: 1500,
              });
              tabelUser.ajax.reload();
          }


        })

      }
      // end function hapus data user


  // ==============================================end script user/Penguna===========================

  // ============================================== Data Data Transaksi===========================

    // input atau sken data buku untuk cari data peminjaman
    $(".kodeBukuAnggota").keyup(function(e){
      if(e.keyCode == 13)
      {
       let key = $(this).val();
       let url=$('.url').val();
        //  jalankan pencarian data
        $.ajax({
          method:'post',
          data:{
            key:key,
          },
          dataType:'json',
          url:url+'Transaksi',
          success:function(data){
            $('.container-data-peminjaman tbody').html("");
            if(data.pesan=='kosong'){
                  $(this).val('');
                  Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Error',
                    text:'Tidak ada data buku dan anggota yang cocok',
                    showConfirmButton: false,
                    timer: 2000,
                    });
                    $('.kodeBukuAnggota').focus();
                    $('.container-data-peminjaman tbody').append(`
                    <tr>
                      <td collspan="5" align="Center">Data Tidak Ada</td>
                    </tr>
                    `);
            }
            // jika data ada
            else
            {
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'success',
                text:'Data Ditemukan',
                showConfirmButton: false,
                timer: 1000,
              });
              $('.kodeBukuAnggota').focus();

              $.each(data, function (key, value) {
                console.info(value)
                let status= (value.status == 1) ? "Blm Kembali":"Sdh Kembali";
                let jenis=value.jenisPinjaman=="P"? "Buku PKT":"Buku Harian";
                  $('.container-data-peminjaman tbody').append(`
                      <tr>
                        <td>${value.nama}</td>
                        <td>${value.judul}</td>
                        <td>${value.kodeBuku}</td>
                        <td>${value.tglPinjam}</td>
                        <td>${jenis}</td>
                        <td>${status}</td>
                      </tr>
                  `);
              })
            }
          }

        })



       $(this).val('');

      }
    });
   
    
     

  // ============================================== End Data Data Transaksi=======================

  // ============================================== Scrip  data kategori=======================

      // data tables kategori
      var url = $('.url').val()
      var tabelKategori = $('#kategoriTable').DataTable({
        "scrollY": "270px",
        "scrollCollapse": true,
        "paging": true,
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": url + 'Kategori/GetDataKategoriAll',
          "type": "POST"
        },

        "columnDefs": [{

            "targets": [3,-1],
            "orderable": false
          }

        ]
      });
      // end data tables kategori

      // tombol tambah kategori buku
        $('#tombolTambahDataKategori').on('click',function(){
          $('.formKategori')[0].reset()
        })
      // end tombol tambah kategori buku

      // tombol Edit data kategori
          $('.table-custum').on('click','.tombolEditKategori',function(){
            $('.loading').css('top', '0')
            $('.gambar-loading').css('opacity', '1')
            $('#modalEditKategori').modal('show');
              $('.dataRoles').val('');
              $('.id').val('');
              $('.nama').val('');
            let id=$(this).data('id');
            let url = $('.url').val();
            $.ajax({
              url:url+'Kategori/getDataKategoriById',
              dataType:'json',
              data:{
                id:id
              },
              method:'post',
              success:function(respon){
              $('.kategori').val(respon.kategori);
              $('.kodeKategori').val(respon.idKategori);
              $('.id').val(respon.idKategori);
              $('.loading').css('top', '100%')
              $('.gambar-loading').css('opacity', '0')
              }
          });
        
        });
      // end tombol edit data kategori

      // tombol Hapus data Ketegori
        $('.table-custum').on('click','.tombolHapusKategori',function(){
          let id = $(this).data('id');
          Swal.fire({
            title: 'Anda Yakin?',
            text: "Ingin Menghapus Data Kategori",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin!, Hapus Saja'
          }).then((result) => {
            if (result.value) {
              hapusDataKategori(id);
              tabelKategori.ajax.reload();
            }
          })
        });
      // end tombol hapus Data Kategori

      // validasi form tambah kategori
      var url =$('.url').val();
      $('.formKategori').validate({
        // rules
        rules:{
            'kategori':{
              required:true
            },
            'kodeKategori':{
              required:true,
              number:true,
              maxlength:3,
              minlength:3,
              remote: {
                url: url + "Kategori/CekKode",
                type: "post"
            }
            }
          },
          // end rules
      
          // message
          messages:{
            'kategori':'kategori Harus Diisi',
            'kodeKategori':{
              required:'kodeKategori tidak boleh kosong',
              number:'Isi Dengan Number',
              maxlength:'Maxsimal tiga digit',
              minlength:'Minimal tiga digit',
              remote:'kode ini sudah digunakan'
            },
    
          },
          // end messages
      
          // submit hendler
          submitHandler:function(form){
            Swal.fire({
                title:'Yakin ?',
                icon:'success',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes'
      
            }).then((result)=>{
              if(result.value){
                simpanDataKategori();
                tabelKategori.ajax.reload();

              }
              else{
                return false;
              }
            })
            // end sweet alert
          }
          // end sumbit henler
      })
      // end validasi form tambah kategori

      // form validasi edit kategori
      $('.formEditKategori').validate({
        // rules
        rules:{
            'kategori':{
              required:true
            },
            'kodeKategori':{
              required:true,
              number:true,
              maxlength:3,
              minlength:3
            }
          },
          // end rules
      
          // message
          messages:{
            'kategori':'kategori Harus Diisi',
            'kodeKategori':{
              required:'kodeKategori tidak boleh kosong',
              number:'Isi Dengan Number',
              maxlength:'Maxsimal tiga digit',
              minlength:'Minimal tiga digit'
            },
    
          },
          // end messages
      
          // submit hendler
          submitHandler:function(form){
            Swal.fire({
                title:'Yakin ?',
                icon:'success',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes'
      
            }).then((result)=>{
              if(result.value){
                prosesEditKategori();
                tabelKategori.ajax.reload();

              }
              else{
                return false;
              }
            })
            // end sweet alert
          }
          // end sumbit henler
      })
      // end form validasi edit kategori


      // function simpan kategori
      function simpanDataKategori(){
        let dataForm= $('.formKategori').serialize();
        let url =$('.url').val();
        $.ajax({
            url:url+'Kategori/SimpanKategori',
            method:'post',
            data:dataForm,
            // dataType:'json',
            success:function(){
              Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Data Berhasil Tersimpan',
                  showConfirmButton: false,
                  timer: 1500,
                });

                $('.formKategori')[0].reset();
                tabelKategori.ajax.reload();
                
              }
          })
        }
      // end function simpan edit kategori

      // function edit data kategori
      function prosesEditKategori(){
        let dataForm= $('.formEditKategori').serialize();
        let url =$('.url').val();
        $.ajax({
            url:url+'Kategori/editDataKategori',
            method:'post',
            data:dataForm,
            // dataType:'json',
            success:function(){
              Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Data Berhasil Diedit',
                  showConfirmButton: false,
                  timer: 1500,
                });
                tabelKategori.ajax.reload();
                
              }
          })
      }
      // end function edit data kategori

  // ============================================== end scrip data kategori buku=====================


  // ================================= informasi data buku untuk pengunjung========================

      // data table informasi buku pengunjung books
      var url = $('.url').val()
      var tabelBooksInformasi = $('#tableBooks').DataTable({
        "scrollY": "42vh",
        "scrollCollapse": true,
        "paging": true,
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": url + 'Books/BooksAll',
          "type": "POST"
        },

        "columnDefs": [{

          "targets": [4,-1],
          "orderable": false
        }

      ]
      });

  // ================================= end informasi data buku untuk pengunjung====================


  // ================================== Peminjaman Buku Paket======================================
  // cari anggota berdasrkan nama
  $('.inputKodeAnggotaPaket').keyup(function(){
    let key =$(this).val();
    $.ajax({
      method:'post',
      data:{
        key:key,
      },
      dataType:'json',
      url:url+'Paket/cariAnggota',
      success:function(data){
        $('.content-cari .list-group').html('')
        $.each(data, function (key, value) {
          $('.content-cari .list-group').append(`
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="#" data-id="`+value.id+`" class="pilihAnggotaPinjamPaket">
                 `+value.nama+`
              </a>
              <span class="badge badge-primary badge-pill">`+value.kelas+`</span>
            </li>
          
          `);
        })
      }

    })
  })

  // pilih anggota perpus yang akan pinjam paket berdasarkan pencarian nama
  $('.content-cari').on('click','.pilihAnggotaPinjamPaket',function(){
    let kodeAnggota=$(this).data('id');
    $('.content-cari .list-group').html('')
     // jalankan ajax cek kode anggota
     $.ajax({
      method:'post',
      data:{
        kodeAnggota:kodeAnggota,
      },
      dataType:'json',
      url:url+'Admin/CekKodeAnggota',
      success:function(data){
        // jika data anggota tidak ditemukan
        if(data.pesan=='kosong'){
          $("#kodeAnggota").focus();
           $('#kodeAnggota').val('');

          Swal.fire({
            position: 'top',
            icon: 'error',
            title: 'Data Anggota Tidak Ditemukan',
            showConfirmButton: false,
            timer: 2000,
          });

        }
        // jika data ada
        else if(data.pesan=='ada')
        {
          $("#kodeAnggota").css("display", "none");
          $('.inputKodeBukuPaket').css('display','block');
          $('.inputKodeBukuPaket').focus();
          cekSessionAnggota();
          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Data Anggota Ditemukan',
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }

    })
    // end ajak cek kode anggota

  })

   // input input kode buku untuk ke tabel kranjang
      $(".inputKodeBukuPaket").keyup(function(e){
        if(e.keyCode == 13)
        {
        let kodeBuku = $('.inputKodeBukuPaket').val();
        let url=$('.url').val();
          //  jalankan ajax simpan ke keranjag buku
          $.ajax({
            method:'post',
            data:{
              kodeBuku:kodeBuku,
            },
            dataType:'json',
            url:url+'Paket/cekKodeBuku',
            success:function(data){
              // jika data anggota tidak ditemukan
              if(data.pesan=='kosong'){
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Data Buku Tidak Ditemukan',
                  showConfirmButton: false,
                  timer: 2000,
                });

              }
              // jika data ada
              else if(data.pesan=='ada')
              {
                $('.inputKodeBukuPaket').focus();
                tabelKeranjangPaket.ajax.reload();

              }
              else if(data.pesan=='sudahAda'){
                $('.inputKodeBukuPaket').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'warning',
                  title: 'Buku Sudah Terinput',
                  showConfirmButton: false,
                  timer: 2000,
                });
              }

              // sudah lebih dari max peminjaman
              else if(data.pesan=='full'){
                $('.inputKodeBukuPaket').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Terjadi Kesalahan',
                  text: 'Mohon Maaf !!! Maxsimal Peminjaman Buku Paket '+data.maxPeminjamanPaket+', Saat ini buku yang akan di proses Berjumlah '+data.jmlKeranjang+', dan ada '+data.jmlBelumKembali+' buku Yang Belum Di kembalikan ',
                  showConfirmButton: true,
                  // timer: 2000,
                });
              }

              else if(data.pesan=='dipinjam'){
                $('.inputKodeBukuPaket').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Terjadi Kesalahan',
                  text: 'Buku ini masih tercatat/atau sedang di pinjam oleh '+data.peminjaman.nama+' kelas '+data.peminjaman.kelas+'. Harusnya Buku ini tidak berada di perpus',
                  showConfirmButton: true,
                  // timer: 2000,
                });

              }
            }

          })
        $(this).val('');

        }
      });
  // end input input kode buku untuk ke tabel kranjang


  // menampilkan keranjang buku paket
    var url = $('.url').val()
    var tabelKeranjangPaket = $('#tabelKeranjangPaket').DataTable({
      "scrollY": "270px",
      "scrollCollapse": true,
      "paging": true,
      "searching": false,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": url + 'Paket/GetDataKeranjangPaket',
        "type": "POST"
      },

      "columnDefs": [{
          "targets": [3],
          "orderable": false
        }

      ]
    });
  // end menampilkan buku paket
  
    // tombol hapus item keranjang buku PAKET
    $('.table-custum').on('click','.tombolHapusItemKeranjangBukuPaket',function(){
      let id = $(this).data('id');
      Swal.fire({
        title: 'Anda Yakin?',
        text: "Ingin Menghapus Item",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!, Hapus Saja'
      }).then((result) => {
        if (result.value) {
          hapusDataItemKeranjangBukuPaket(id);
          tabelKeranjangPaket.ajax.reload();

        }
      })
    });

  // function hapus item keranjang buku paket
  function hapusDataItemKeranjangBukuPaket(id){
    let url=$('.url').val();
    $.ajax({
      url:url+'Paket/hapusItemKeranjangBuku',
      data:{
        id:id
      },
      dataType:'json',
      method:'post',
      success:function(respon){
        if(respon.pesan=='ok'){
          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Hapus Data Berhasil',
            showConfirmButton: false,
            timer: 1500,
          });
          tabelKeranjangPaket.ajax.reload();
          $('.inputKodeBukuPaket').focus();

        }else if(respon.pesan=='error'){
          
          Swal.fire({
            position: 'top',
            icon: 'error',
            title: 'Hapus Data gagal',
            showConfirmButton: false,
            timer: 1500,
          });
          tabelKeranjangPaket.ajax.reload();
          $('.inputKodeBukuPaket').focus();


        }
      }


    })

  }
  // end hapus buku paket

    // tombolProses Pinjaman buku Paket
    $('.btn-proses-Pinjaman-bukuPaket').on('click',function(){
      Swal.fire({
        title: 'Anda Yakin?',
        text: "Proses Pinjaman Buku Paket",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!, Proses Saja'
      }).then((result) => {
        if (result.value) {
          prosespinjamanPaket();
          cekSessionAnggota();

          // tabelKeranjangPaket.ajax.reload();
        }
      })
  })

    // function proses peminjaman buku Paket
    function prosespinjamanPaket(){
      let url=$('.url').val();
      $.ajax({
        url:url+'Paket/prosesPinjaman',
        method:'post',
        dataType:'json',
        success:function(respon){
          if(respon.pesan=='sukses'){
            Swal.fire({
              position: 'top',
              icon: 'success',
              title: 'Peminjaman Buku Paket Tercatat',
              showConfirmButton: false,
              timer: 1500,
            });
            resetPeminjamanPaket();
            suksesPinjamPaket(respon.idAnggota);
            $("#kodeAnggota").focus();
            tabelKeranjangPaket.ajax.reload();
          }else if(respon.pesan=='gagal'){
            Swal.fire({
              position: 'top',
              icon: 'error',
              title: 'Pemninjaman gagal Dilakukan',
              text: 'Silahkan Ulangi',
              showConfirmButton: true,
              // timer: 1500,
            });
            tabelKeranjangPaket.ajax.reload();

          }
        }


      })

    }

    $('.print-sukses-paket').on('click',function(){
      printData();
    })

    // modal sukses Pinjam Paket
    function suksesPinjamPaket(idAnggota){
      $.ajax({
        url:url+'Paket/getDataPinjamanBelumKembali',
        method:'post',
        dataType:'json',
        data:{
          idAnggota:idAnggota
        },
        success:function(respon){
          let dataAnggota=respon.dataAnggota;
          let dataPinjaman=respon.dataPinjaman;
          $('#suksesPinjamPaket').modal('show');
          $('.tabelIdentitasAnggota').html('');
          $('.tabelBukuPaketYangDipinjam1 tbody').html('');
          $('.tabelIdentitasAnggota').append(`
            <tr>
                <th>ID</th>
                <td>:</td>
                <td>`+dataAnggota.id+`</td>
                <th>Kelas</th>
                <td>:</td>
                <td>`+dataAnggota.kelas+`</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>`+dataAnggota.nama+`</td>
            </tr>
          `);

          $.each(dataPinjaman, function (key, value) {

            $('.tabelBukuPaketYangDipinjam1 tbody').append(`
              <tr>
                <td>`+value.idBuku+`</td>
                <td>`+value.kodeBuku+`</td>
                <td>`+value.judul+`</td>
                <td>`+value.tglPinjam+`</td>
             </tr>
            `);
          })

        }
      })

    }
    $('.suksesPinjamPaket').on('click',function(){
      $('#suksesPinjamPaket').modal('show');

    })

      // tombol reset peminjaman Paket
      $('.button-reset-pinjaman-paket').on('click',function(){
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Reset Peminjaman Buku Paket",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, Reseet Saja'
        }).then((result) => {
          if (result.value) {
            resetPeminjamanPaket();
          }
        })
      })

      // funtion reset peminjaman Paket
      function resetPeminjamanPaket(){
      let url=$('.url').val();
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Paket/resetPeminjaman',
          success:function(data){
            console.log(data)
            if(data.pesan == 'sukses'){
              loadDataAnggota()
              $('#kodeAnggota').val('');
              $('#kodeAnggota').focus();
              $("#kodeAnggota").css("display", "block");
              $('.inputKodeBukuPaket').css('display','none');
              tabelKeranjangPaket.ajax.reload();
            }else{
              $('.inputKodeBukuPaket').focus();
              $("#kodeAnggota").css("display", "none");
              $('.inputKodeBukuPaket').css('display','block');
              tabelKeranjangPaket.ajax.reload();
              
            }

          }
        })
      }




  // ================================== End Peminjaman Buku Paket====================================================

  // ==================================Pengembalian Buku Paket=======================================================
   // input kode buku pengembalian
   $(".inputKodeBukuPengembalianPaket").keyup(function(e){
    if(e.keyCode == 13)
    {
     let kodeBukuPengembalian = $('.inputKodeBukuPengembalianPaket').val();
     let url=$('.url').val();
      //  jalankan ajax simpan ke keranjag BukuPengembalian
      $.ajax({
        method:'post',
        data:{
          kodeBukuPengembalian:kodeBukuPengembalian,
        },
        dataType:'json',
        url:url+'Paket/cekKodeBukuPengembalian',
        success:function(data){
          if(data.pesan=='kosong'){
            Swal.fire({
              position: 'top',
              icon: 'error',
              title: 'Data Buku Tidak Cocok',
              showConfirmButton: false,
              timer: 2000,
            });

          }
          // jika data ada
          else if(data.pesan=='ada')
          {
            Swal.fire({
              position: 'top',
              icon: 'success',
              title: 'Data Cocok',
              showConfirmButton: false,
              timer: 1000,
            });
            $('.inputKodeBukuPengembalianPaket').focus();
            cekSessionAnggotaPengembalianBukuPaket();
            //  dataPeminjamanAll('P');
          }
          else if(data.pesan=='sudahAda'){
            $('.inputKodeBukuPengembalianPaket').focus();
            Swal.fire({
              position: 'top',
              icon: 'warning',
              title: 'Buku ini Sudah Di cocokan',
              showConfirmButton: true,
              // timer: 2000,
            });
          }
        }

      })


     $(this).val('');

    }
  });
  // end input kode buku pengembalian
      // cari anggota yang akan kembalikan  berdasrkan nama
        $('.kodeAnggotaPengembalian').keyup(function(){
          let key =$(this).val();
          $.ajax({
            method:'post',
            data:{
              key:key,
            },
            dataType:'json',
            url:url+'Paket/cariAnggota',
            success:function(data){
              $('.content-cari .list-group').html('')
              $.each(data, function (key, value) {
                $('.content-cari .list-group').append(`
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" data-id="`+value.id+`" class="pilihAnggotaPinjamPaket">
                      `+value.nama+`
                    </a>
                    <span class="badge badge-primary badge-pill">`+value.kelas+`</span>
                  </li>
                
                `);
              })
            }

          })
        })

      // pih data dari hasil cari anggota yang akan kembalikan buku paket
      $('.content-cari').on('click','.pilihAnggotaPinjamPaket',function(){
        let kodeAnggota=$(this).data('id');
        $('.content-cari .list-group').html('')
         // jalankan ajax cek kode anggota
         $.ajax({
          method:'post',
          data:{
            kodeAnggota:kodeAnggota,
          },
          dataType:'json',
          url:url+'Admin/CekKodeAnggota',
          success:function(data){
            // jika data anggota tidak ditemukan
            if(data.pesan=='kosong'){
              $("#kodeAnggotaPengembalian").focus();
               $('#kodeAnggotaPengembalian').val('');
    
              Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Data Anggota Tidak Ditemukan',
                showConfirmButton: false,
                timer: 2000,
              });
    
            }
            // jika data ada
            else if(data.pesan=='ada')
            {
              $("#kodeAnggotaPengembalian").css("display", "none");
              $('.inputKodeBukuPengembalian').css('display','block');
              $('.inputKodeBukuPengembalian').focus();
              cekSessionAnggotaPengembalianBukuPaket();
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Data Anggota Ditemukan',
                showConfirmButton: false,
                timer: 2000,
              });
            }
          }
    
        })
        // end ajak cek kode anggota
    
      })

      // untuk mengecek data pengembalin buku paket
       // cek session anggota Untuk Penegmbalian buku
       function cekSessionAnggotaPengembalianBukuPaket(){
        let url=$('.url').val();
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/CekSessionAnggota',
          success:function(data){
            if(data.pesan == 'ada'){
              // createSessionJenisPengembalianBuku('P');
              loadDataAnggotaPengembalian()
              $('.inputKodeBukuPengembalianPaket').focus();
              $("#kodeAnggotaPengembalian").css("display", "none");
              $('.inputKodeBukuPengembalianPaket').css('display','block');
              dataPeminjamanAll('P')
            }else if(data.pesan=='Tidakada'){
              loadDataAnggotaPengembalian()
              $('#kodeAnggotaPengembalian').val('');
              $('#kodeAnggotaPengembalian').focus();
              $("#kodeAnggotaPengembalian").css("display", "block");
              $('.inputKodeBukuPengembalianPaket').css('display','none');
            }

          }
        })
      }

         // tombol reset Pengembalian paket
         $('.button-reset-pengembalian-paket').on('click',function(){
          Swal.fire({
            title: 'Anda Yakin?',
            text: "Reset Pengembalian Paket",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin!, reset Saja'
          }).then((result) => {
            if (result.value) {
              resetPengembalianPaket();
            }
          })
        })

         // function reset pengembalian Paket
      function resetPengembalianPaket(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Paket/resetPengembalianPaket',
          success:function(data){
            if(data.pesan == 'sukses'){
                cekSessionAnggotaPengembalianBukuPaket();
                // loadDataAnggotaPengembalian()  
                dataPeminjamanAll('P')
            }else{
              cekSessionAnggotaPengembalianBukuPaket();
              // loadDataAnggotaPengembalian()
              dataPeminjamanAll('P')
            }

          }
        })
      }

      // tobol proses simpan pengembalian paket
      $('.btn-proses-kembali-paket').on('click',function(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Paket/cekjumlahBukuDendaYangDikembalikan',
          success:function(data){
            if(data.pesan == 'sukses'){
              if(data.jumlahKembali == 0){
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Tidak Ada Buku Yang Akan Di kembalikan',
                  text:'Silahkan Cocokan buku yang akan dikembalikan dengan cara scan buku',
                  showConfirmButton: true,
                });
                $(".inputKodeBukuPengembalianPaket").focus();
              }
              else if(data.jumlahKembali > 0){
                    Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Buku Yang Akan Dikembalikan bejumlah "+data.jumlahKembali+" Buku. Apakah Sudah Benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya Benar!, Proses  Saja'
                  }).then((result) => {
                    if (result.value) {
                      simpanPengembalianBukuPaket();
                    }
                  })

              }

            }

          }
        })
      
      })

       // function proses pengembalian buku Paket
       function simpanPengembalianBukuPaket(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Paket/simpanPengembalianPaket',
          success:function(data){
            if(data.pesan == 'sukses'){
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Pengembalian Buku Paket Tercatat',
                showConfirmButton: false,
                timer: 2000,
              });
              resetPengembalianPaket();
            }

          }
        })

      }

      // tombol function sesuai kode buku
      $(".table-custum").on('click','#btnSesuai',function(){
     
          const kode =$(this).data("kode");
          sesuaiKode(kode)

      })

        // tombol function sesuai kode buku dan print ulang barode nya
        $(".table-custum").on('click','#btnPrintOk',function(){
          const kode =$(this).data("kode");
          sesuaiDanPrint(kode)

      })



      // function penyesuaian buku manual
      function sesuaiKode(kodeBuku){
        let url=$('.url').val();
        $.ajax({
          method:'post',
          data:{
            kodeBukuPengembalian:kodeBuku,
          },
          dataType:'json',
          url:url+'Paket/cekKodeBukuPengembalian',
          success:function(data){
            if(data.pesan=='kosong'){
              Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Data Buku Tidak Cocok',
                showConfirmButton: false,
                timer: 2000,
              });
  
            }
            // jika data ada
            else if(data.pesan=='ada')
            {
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Data Cocok',
                showConfirmButton: false,
                timer: 1000,
              });
              $('.inputKodeBukuPengembalianPaket').focus();
              cekSessionAnggotaPengembalianBukuPaket();
              //  dataPeminjamanAll('P');
            }
            else if(data.pesan=='sudahAda'){
              $('.inputKodeBukuPengembalianPaket').focus();
              Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Buku ini Sudah Di cocokan',
                showConfirmButton: true,
                // timer: 2000,
              });
            }
          }
  
        })
      }


      // function cocokan pengembalian buka dan print ulang barcode
      function sesuaiDanPrint(kode){
        let url=$('.url').val();
        $.ajax({
          method:'post',
          data:{
            kodeBukuPengembalian:kode,
          },
          dataType:'json',
          url:url+'Paket/cekKodeBukuPengembalian',
          success:function(data){
            if(data.pesan=='kosong'){
              Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Data Buku Tidak Cocok',
                showConfirmButton: false,
                timer: 2000,
              });
  
            }
            // jika data ada
            else if(data.pesan=='ada')
            {
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Data Cocok',
                showConfirmButton: false,
                timer: 1000,
              });
              $('.inputKodeBukuPengembalianPaket').focus();
              cekSessionAnggotaPengembalianBukuPaket();
              printBarcodeUlang(kode)
              //  dataPeminjamanAll('P');
            }
            else if(data.pesan=='sudahAda'){
              $('.inputKodeBukuPengembalianPaket').focus();
              Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Buku ini Sudah Di cocokan',
                showConfirmButton: true,
                // timer: 2000,
              });
            }
          }
  
        })
      }

      function printBarcodeUlang(kode){
        let url=$('.url').val();
          $.ajax({
            type: 'POST',
            url: url+'Buku/printBarcodeSatuan',
            data: {id:kode},
            dataType:'json',
            success: function (data) {
            $('.loading').css('top', '100%');
            $('.gambar-loading').css('opacity', '0');
            }
          })
      }



      
   
  // ==================================Akhir Pengembalian Buku Paket=================================================


  // ==============================================scrip peminjaman buku leguler=====================

      // load dta untuk tables keranjang buku
        var url = $('.url').val()
        var tabelKeranjang = $('#peminjamanRegTable').DataTable({
          "scrollY": "270px",
          "scrollCollapse": true,
          "paging": true,
          "searching": false,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.

          // Load data for the table's content from an Ajax source
          "ajax": {
            "url": url + 'Admin/GetDataPeminjamanRegAll',
            "type": "POST"
          },

          "columnDefs": [{
              "targets": [3],
              "orderable": false
            }

          ]
        });
      // end load data tables  keranjang buku

      // input kode anggota
      $("#kodeAnggota").focus();
      $("#kodeAnggota").keyup(function(e){
        let url=$('.url').val();
        let kodeAnggota = $(this).val();
        if(e.keyCode == 13)
        {
          // jalankan ajax cek kode anggota
          $.ajax({
            method:'post',
            data:{
              kodeAnggota:kodeAnggota,
            },
            dataType:'json',
            url:url+'Admin/CekKodeAnggota',
            success:function(data){
              // jika data anggota tidak ditemukan
              if(data.pesan=='kosong'){
                $("#kodeAnggota").focus();
                 $('#kodeAnggota').val('');

                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Data Anggota Tidak Ditemukan',
                  showConfirmButton: false,
                  timer: 2000,
                });

              }
              // jika data ada
              else if(data.pesan=='ada')
              {
                $("#kodeAnggota").css("display", "none");
                $('.inputKodeBuku').css('display','block');
                $('.inputKodeBuku').focus();
                cekSessionAnggota();
                Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Data Anggota Ditemukan',
                  showConfirmButton: false,
                  timer: 2000,
                });
              }
            }

          })
          // end ajak cek kode anggota
          // alert('ok')
          // $('#modalUser').modal('show')
        }
      });
      // end input kode anggota


      // input input kode buku untuk ke tabel kranjang
      $(".inputKodeBuku").keyup(function(e){
        if(e.keyCode == 13)
        {
         let kodeBuku = $('.inputKodeBuku').val();
         let url=$('.url').val();
          //  jalankan ajax simpan ke keranjag buku
          $.ajax({
            method:'post',
            data:{
              kodeBuku:kodeBuku,
            },
            dataType:'json',
            url:url+'Admin/cekKodeBuku',
            success:function(data){
              // jika data anggota tidak ditemukan
              if(data.pesan=='kosong'){
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Data Buku Tidak Ditemukan',
                  showConfirmButton: false,
                  timer: 2000,
                });

              }
              // jika data ada
              else if(data.pesan=='ada')
              {
                $('.inputKodeBuku').focus();
                tabelKeranjang.ajax.reload();

              }
              else if(data.pesan=='sudahAda'){
                $('.inputKodeBuku').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'warning',
                  title: 'Buku Sudah Terinput',
                  showConfirmButton: false,
                  timer: 2000,
                });
              }

              // sudah lebih dari max peminjaman
              else if(data.pesan=='full'){
                $('.inputKodeBuku').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Terjadi Kesalahan',
                  text: 'Mohon Maaf !!! Maxsimal Peminjaman Buku Reguler '+data.maxPeminjaman+', Saat ini buku yang akan di proses Berjumlah '+data.jmlKeranjang+', dan ada '+data.jmlBelumKembali+' buku Yang Belum Di kembalikan ',
                  showConfirmButton: true,
                  // timer: 2000,
                });
              }

              else if(data.pesan=='dipinjam'){
                $('.inputKodeBuku').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Terjadi Kesalahan',
                  text: 'Buku ini masih tercatat/atau sedang di pinjam oleh '+data.peminjaman.nama+' kelas '+data.peminjaman.kelas+'. Harusnya Buku ini tidak berada di perpus',
                  showConfirmButton: true,
                  // timer: 2000,
                });

              } 
            }

          })
         $(this).val('');

        }
      });
      // end input input kode buku untuk ke tabel kranjang

      
      //function load data anggota
      function loadDataAnggota(){
        $('.box-user .name-user').html('');
        $('.box-user .user-kelas').html('');
        $('.box-user .user-nis').html('');
        $('.box-user .user-kunjungan').html('');
        $('.box-informasi .table tbody').html('');
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/loadDataAnggotaByIdSession',
          success:function(data){
            
            $('.box-user .name-user').append(`
            <h6 class="user-nama">`+data.nama+`</h6>
            <h6 class="id-user">`+data.id+`</h6>
            <h6 class="join-user">`+ data.tanggal+`</h6>
            `);

            $('.box-user .user-kelas').append(`
                <th>Kelas</th>
                <td>:</td>
                <td>`+data.kelas+`</td>
            `);

            $('.box-user .user-nis').append(`
                <th>NIS/NISN</th>
                <td>:</td>
                <td>`+data.nis+`/ `+data.nisn+`</td>
            `);

            $('.box-user .user-kunjungan').append(`
            <th>Jml Kunjungan</th>
            <td>:</td>
            <td>`+data.kunjungan+`</td>
            `);
          
            // ambil data dinjaman by ajak
            $.ajax({
              method:'post',
              dataType:'json',
              url:url+'Admin/getDataPinjamanByAnggota',
              success:function(respon){
                $.each(respon, function (key, value) {
                  $('.box-informasi .table tbody').append(`
                    <tr>
                        <td>`+value.judul+`</td>
                        <td>`+value.lamaPinjam+` Hari</td>
                    </tr>
                  
                  `);
                })
              }
            })
         
          }
        })
      }
      // end funtion load data anggota

      cekSessionAnggota()
      // cek session anggota
      function cekSessionAnggota(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/CekSessionAnggota',
          success:function(data){
            if(data.pesan == 'ada'){
              loadDataAnggota()
              $('.inputKodeBuku').focus();
              $("#kodeAnggota").css("display", "none");
              $('.inputKodeBuku').css('display','block');
              $('.inputKodeBukuPaket').css('display','block');
            }else if(data.pesan=='Tidakada'){
              $('#kodeAnggota').focus();
              $("#kodeAnggota").css("display", "block");
              $('.inputKodeBuku').css('display','none');
              $('.inputKodeBukuPaket').css('display','none');
            }

          }
        })
      }


      // funtion reset peminjaman reguler
      function resetPeminjamanReguler(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/resetPeminjaman',
          success:function(data){
            if(data.pesan == 'sukses'){
              loadDataAnggota()
              $('#kodeAnggota').val('');
              $("#kodeAnggota").css("display", "block");
              $('.inputKodeBuku').css('display','none');
              $('.inputKodeBukuPengembalian').css('display','none');
              tabelKeranjang.ajax.reload();
              dataPeminjamanAll('R')
              $('#kodeAnggota').focus();
            }else{
              $('.inputKodeBuku').focus();
              $("#kodeAnggota").css("display", "none");
              $('.inputKodeBuku').css('display','block');
              $('.inputKodeBukuPengembalian').css('display','block');
              
            }

          }
        })
      }

      // tombol reset peminjaman regulesr
      $('.button-reset').on('click',function(){
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Reset Peminjaman",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, Hapus Saja'
        }).then((result) => {
          if (result.value) {
          resetPeminjamanReguler();
          }
        })
      })

    // tombol hapus item keranjang buku
      $('.table-custum').on('click','.tombolHapusItemKeranjang',function(){
        let id = $(this).data('id');
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Ingin Menghapus Item",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, Hapus Saja'
        }).then((result) => {
          if (result.value) {
            hapusDataItemKeranjang(id);
            tabelKeranjang.ajax.reload();
          }
        })
      });



      // function hapus item keranjang buku
        function hapusDataItemKeranjang(id){
          let url=$('.url').val();
          $.ajax({
            url:url+'Admin/hapusItemKeranjangBuku',
            data:{
              id:id
            },
            method:'post',
            success:function(respon){
              if(respon=='ok'){

                Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Hapus Data Berhasil',
                  showConfirmButton: false,
                  timer: 1500,
                });
                tabelKeranjang.ajax.reload();
              }else if(respon=='error'){
                
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Hapus Data gagal',
                  showConfirmButton: false,
                  timer: 1500,
                });
                tabelKeranjang.ajax.reload();

              }
            }
  
  
          })
  
        }

      // function proses peminjaman buku reguler
          function prosespinjaman(){
            let url=$('.url').val();
            $.ajax({
              url:url+'Admin/prosesPinjaman',
              method:'post',
              dataType:'json',
              success:function(respon){
                if(respon.pesan=='sukses'){
                  Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Peminjaman Buku Tercatat',
                    showConfirmButton: false,
                    timer: 1500,
                  });
                  resetPeminjamanReguler()
                  cekSessionAnggota()
                  $("#kodeAnggota").focus();
                  tabelKeranjang.ajax.reload();
                }else if(respon.pesan=='gagal'){
                  Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Pemninjaman gagal Dilakukan',
                    text: 'Silahkan Ulangi',
                    showConfirmButton: true,
                    // timer: 1500,
                  });
                  tabelKeranjang.ajax.reload();

                }
              }
    
    
            })
    
          }

        // tombolProses Pinjaman buku reguler
          $('.btn-proses-Pinjaman').on('click',function(){
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Proses Pinjaman",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!, Proses Saja'
              }).then((result) => {
                if (result.value) {
                  prosespinjaman();
                  tabelKeranjang.ajax.reload();
                }
              })
          })
      
  // ==============================================end scrip peminjaman buku leguler========================



  // ===============================================secrip pengembalian buku Reguler================================
      //function load data anggota pengembalian
      function loadDataAnggotaPengembalian(){
        $('.box-user .name-user1').html('');
        $('.box-user .user-kelas1').html('');
        $('.box-user .user-nis1').html('');
        $('.box-user .user-kunjungan1').html('');
        $('.box-informasi .table1 tbody').html('');
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/loadDataAnggotaByIdSession',
          success:function(data){
           
            
            $('.box-user .name-user1').append(`
            <h6 class="user-nama1">`+data.nama+`</h6>
            <h6 class="id-user1">`+data.id+`</h6>
            <h6 class="join-user1">`+ data.tanggal+`</h6>
            `);

            $('.box-user .user-kelas1').append(`
                <th>Kelas</th>
                <td>:</td>
                <td>`+data.kelas+`</td>
            `);

            $('.box-user .user-nis1').append(`
                <th>NIS/NISN</th>
                <td>:</td>
                <td>`+data.nis+`/ `+data.nisn+`</td>
            `);

            $('.box-user .user-kunjungan1').append(`
            <th>Jml Kunjungan</th>
            <td>:</td>
            <td>`+data.kunjungan+`</td>
            `);
          
            // ambil data dinjaman by ajak
            $.ajax({
              method:'post',
              dataType:'json',
              url:url+'Admin/getDataPinjamanByAnggota',
              success:function(respon){
                $.each(respon, function (key, value) {
                  $('.box-informasi .table1 tbody').append(`
                    <tr>
                        <td>`+value.judul+`</td>
                        <td>`+value.lamaPinjam+` Hari</td>
                    </tr>
                  
                  `);
                })
              }
            })
         
          }
        })
      }
      // end funtion load data anggota

      // Function Get Data pinjaman By Kategori/ jenis Pinjamn
      function dataPeminjamanAll(jenisPinjaman){
        let url =$('.url').val();
        $('#tabelPengembalian tbody').html('')
        $.ajax({
          url:url+'Pengembalian/GetDataPeminjaman',
          data:{jenisPinjaman:jenisPinjaman},
          dataType:'json',
          method:'post',
          success:function(respon){
            if(respon.length===0){
              $('#tabelPengembalian tbody').append(`
                  <tr>
                    <td colspan="7" align="center">Tidak Memiliki Data Peminjaman</td>
                  </tr>
              `)
            }
            let no=1
            let status='';
            let btnStatus='';
            $.each(respon, function (key, value) {
             if(value.status > 0){
              status='<img src="'+url+'assets/Backend/assets/img/icon/check2.png" width="20px"/>'
              btnStatus='btn btn-success';
            }
            else{
              status='<img src="'+url+'assets/Backend/assets/img/icon/checked.png" width="20px"/>'
              btnStatus='btn btn-secondary';
             }
              $('#tabelPengembalian tbody').append(`
                  <tr>
                    <td>`+no+++`</td>
                    <td>`+value.judul+`</td>
                    <td>`+value.kodeBuku+`</td>
                    <td>`+value.idBuku+`</td>
                    <td><button id="btnPrintOk" data-kode="`+value.kodeBuku+`" class="btn btn-primary">Ok & Print</button></td>
                    <td><button id="btnSesuai" data-kode="`+value.kodeBuku+`" class="`+btnStatus+`">Sesuai</button></td>
                    <td>`+status+`</td>
                  </tr>
              `)
            })
          }
        })
      }

      // input kode buku pengembalian
      $(".inputKodeBukuPengembalian").keyup(function(e){
        if(e.keyCode == 13)
        {
         let kodeBukuPengembalian = $('.inputKodeBukuPengembalian').val();
         let url=$('.url').val();
          //  jalankan ajax simpan ke keranjag BukuPengembalian
          $.ajax({
            method:'post',
            data:{
              kodeBukuPengembalian:kodeBukuPengembalian,
            },
            dataType:'json',
            url:url+'Pengembalian/cekKodeBukuPengembalian',
            success:function(data){
              // jika data anggota tidak ditemukan
              if(data.pesan=='kosong'){
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Data Buku Tidak Cocok',
                  showConfirmButton: false,
                  timer: 2000,
                });

              }
              // jika data ada
              else if(data.pesan=='ada')
              {
                Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Data Cocok',
                  showConfirmButton: false,
                  timer: 1000,
                });
                $('.inputKodeBukuPengembalian').focus();
                 dataPeminjamanAll('R');
              }
              else if(data.pesan=='sudahAda'){
                $('.inputKodeBukuPengembalian').focus();
                Swal.fire({
                  position: 'top',
                  icon: 'warning',
                  title: 'Buku ini Sudah Di cocokan',
                  showConfirmButton: true,
                  // timer: 2000,
                });
              }
            }

          })
         $(this).val('');

        }
      });
      // end input kode buku pengembalian


       // input kode anggota Untuk pengembalian buku harian
       $("#kodeAnggotaPengembalian").focus();
       $("#kodeAnggotaPengembalian").keyup(function(e){
         let url=$('.url').val();
         let kodeAnggota = $(this).val();
         if(e.keyCode == 13)
         {
           // jalankan ajax cek kode anggota
           $.ajax({
             method:'post',
             data:{
               kodeAnggota:kodeAnggota,
             },
             dataType:'json',
             url:url+'Admin/CekKodeAnggota',
             success:function(data){
               // jika data anggota tidak ditemukan
               if(data.pesan=='kosong'){
                 $("#kodeAnggotaPengembalian").focus();
                  $('#kodeAnggotaPengembalian').val('');
                 Swal.fire({
                   position: 'top',
                   icon: 'error',
                   title: 'Data Anggota Tidak Ditemukan',
                   showConfirmButton: false,
                   timer: 2000,
                 });
 
               }
               // jika data ada
               else if(data.pesan=='ada')
               {
                 $("#kodeAnggotaPengembalian").css("display", "none");
                 $('.inputKodeBukuPengembalian').css('display','block');
                 $('.inputKodeBukuPengembalian').focus();
                 cekSessionAnggotaPengembalianBuku();
                 Swal.fire({
                   position: 'top',
                   icon: 'success',
                   title: 'Data Anggota Ditemukan',
                   showConfirmButton: false,
                   timer: 2000,
                 });
               }
             }
 
           })
         }
       });
      // end input kode anggota Untuk pengembalian buku harian

      // cek session anggota Untuk Penegmbalian buku
      function cekSessionAnggotaPengembalianBuku(){
        let url=$('.url').val();
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Admin/CekSessionAnggota',
          success:function(data){
            if(data.pesan == 'ada'){
              createSessionJenisPengembalianBuku('R');
              loadDataAnggotaPengembalian()
              $('.inputKodeBukuPengembalian').focus();
              $("#kodeAnggotaPengembalian").css("display", "none");
              $('.inputKodeBukuPengembalian').css('display','block');
              dataPeminjamanAll('R')
            }else if(data.pesan=='Tidakada'){
              loadDataAnggotaPengembalian()
              $('#kodeAnggotaPengembalian').val('');
              $('#kodeAnggotaPengembalian').focus();
              $("#kodeAnggotaPengembalian").css("display", "block");
              $('.inputKodeBukuPengembalian').css('display','none');
            }

          }
        })
      }
   
      // function buat session pengembalian jenis buku
      function createSessionJenisPengembalianBuku(jenisPinjaman){
        let url=$('.url').val();
         $.ajax({
           url:url+'Pengembalian/createSessionJenisPinjaman',
           data:{
             data:jenisPinjaman
           },
           dataType:'json',
           method:'post',
           success:function(respon){
             

           }
         })
      }
     


      // function reset pengembalian harian
      function resetPengembalian(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Pengembalian/resetPengembalian',
          success:function(data){
            if(data.pesan == 'sukses'){
                cekSessionAnggotaPengembalianBuku()
                loadDataAnggotaPengembalian()  
                dataPeminjamanAll('R')
            }

          }
        })
      }

      // function proses pengembalian buku reguler
      function simpanPengembalianBukuR(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Pengembalian/simpanPengembalianReg',
          success:function(data){
            if(data.pesan == 'sukses'){
              Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Pengembalian Buku Tercatat',
                showConfirmButton: false,
                timer: 2000,
              });
              resetPengembalian();
            }

          }
        })

      }

      // tombol reset Pengembalian harian
      $('.button-reset-pengembalian').on('click',function(){
        Swal.fire({
          title: 'Anda Yakin?',
          text: "Reset Pengembalian",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin!, reset Saja'
        }).then((result) => {
          if (result.value) {
            resetPengembalian();
          }
        })
      })

      // tobol proses simpan pengembalian
      $('.btn-proses-kembali-Reg').on('click',function(){
        $.ajax({
          method:'post',
          dataType:'json',
          url:url+'Pengembalian/cekjumlahBukuDendaYangDikembalikan',
          success:function(data){
            if(data.pesan == 'sukses'){
              if(data.jumlahKembali == 0){
                Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: 'Tidak Ada Buku Yang Akan Di kembalikan',
                  text:'Silahkan Cocokan buku yang akan dikembalikan dengan cara scan buku',
                  showConfirmButton: true,
                });
                $(".inputKodeBukuPengembalian").focus();
              }
              else if(data.jumlahKembali > 0){
                    Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Buku Yang Akan Dikembalikan bejumlah "+data.jumlahKembali+" Buku. Apakah Sudah Benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya Benar!, Proses  Saja'
                  }).then((result) => {
                    if (result.value) {
                      simpanPengembalianBukuR();
                    }
                  })

              }

            }

          }
        })
      
      })


          
  // ===============================================end secrip pengembalian buku============================

  $('.loading').css('top', '100%');
  $('.gambar-loading').css('opacity', '0');

  });
// documen redy function

// function login data user
$(".form-login #loginUser").keyup(function(e){
  let url=$('.url').val();
    if(e.keyCode == 13)
    {
      kodePengunjung=$(this).val()
      $.ajax({
        url:url+'Pengunjung/CekLogin',
        dataType:'json',
        method:'post',
        data:{
          id:kodePengunjung
        },
        success:function(response){
          $('.modal-body .user-data').html('')
         if(response.pesan=='ok'){
          $(".form-login #loginUser").val('');
          $('.modal-body .user-data').append(`
              <h4>SELAMAT DATANG `+response.nama+` </h4>
              <p>Silahkan Pilih Tujuan Kunjungan Perpustakaan </p>
          `)
          $('#modalUser').modal('show')
         }
         else if(response.pesan=='belumAktif'){
          $(".form-login #loginUser").val('');
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Kartu Belum Diaktifkan',
            text:'Hubungi Petugas',
            showConfirmButton: true,
            // timer: 2000,
          });

         }
         else{
           $(".form-login #loginUser").val('');
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Kartu Tidak Valid',
            text:'Hubungi Petugas',
            showConfirmButton: true,
            // timer: 2000,
          });
         }
        }

      })
    
    }
  });
// end login data user

// buku Tamu pilih item kunjungan
$('.labelBukuTamu').on('click', function(){
   let cekClass = $(this).hasClass('tbl-clik');
    if(cekClass == true){
      $(this).removeClass('tbl-clik')
    }
    else if(cekClass==false){
      $(this).addClass('tbl-clik')
    }
})


// simpan item kunjungan ke table
$('.form-buku-tamu').submit(function(e){
  e.preventDefault()
  let url = $('.url').val();
  let data =$(this).serialize();
  // alert(data);
  if(data==''){
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Silahkan Pilih Tujuan Kunjungan Anda',
      showConfirmButton: true,
      // timer: 2000,
    });
  } 
  else{
    $.ajax({
      url:url+'Pengunjung/simpanKunjungan',
      method:'post',
      dataType:'json',
      data:data,
      success:function(respon){
        if(respon.pesan=='sukses'){
          $('#myChart').load(url + 'grafik');
          // kunjungan()
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Terimakasih Buku Kunjungan Tersimpan',
            showConfirmButton: false,
            timer: 2000,
          });
          $('#modalUser').modal('hide');
          $('.labelBukuTamu').removeClass('tbl-clik')
          $('.form-buku-tamu')[0].reset();
          $('#loginUser').focus();

        }else if(respon.pesan=='error'){
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'isi Buku kunjungan Hanya Sekali 1 hari',
            showConfirmButton: false,
            timer: 2000,
          });
          $('.labelBukuTamu').removeClass('tbl-clik')
          $('.form-buku-tamu')[0].reset();
          $('#loginUser').focus();
          $('#modalUser').modal('hide');

        }
      }

      
    })
  }
})



// owl Carosel
function perpusCarousel(){
  var owl = $('.owl-carousel');
  owl.owlCarousel({
      animateOut: 'slideOutDown',
      animateIn: 'flipInX',
      items:2,
      loop:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsiveClass:true,
    });
}

// function data grapik kunjungan
function kunjungan(){
  let url=$('.url').val();
  $.ajax({
    url: url+'Grafik/kunjungan',
    method: "post",
    dataType:"json",
    success: function(data) {
        // console.log(data);
        // membuat variabel
        var label = [];
        var baca = [];
        var kembali = [];
        var pinjam = [];
        // looping semua data dari response
        for (var i in data) {
          label.push(data[i].bulan);
          baca.push(data[i].baca);
          kembali.push(data[i].kembali);
          pinjam.push(data[i].pinjam);
        }
         // chart
			var ctx = document.getElementById('myChart');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: label,
          
          datasets: [{
            label: ['Membaca'],
            data: baca,
            backgroundColor: [
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              'rgb(76, 181, 245)',
              
            ],
        
            borderWidth: 1
          },
            // data f2
            {
              label: ['Peminjaman'],
              data: pinjam,
              backgroundColor: [
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              'rgb(255, 66, 14)',
              
              ],
          
              borderWidth: 1
            },

            // suara f3
            {
              label: ['Pengembalian'],
              data: kembali,
              backgroundColor: [
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              'rgb(27, 20, 219)',
              
              ],
          
              borderWidth: 1
            }
        
          ]

        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
          
  // end cart


        
        
    }
    // sucess

  });
}

// function data pengunjung perkelas
function KunjunganPerkelas(){
  let url=$('.url').val();
  $.ajax({
    url: url+'Grafik/kunjunganPerkelas',
    method: "post",
    dataType:"json",
    success: function(data) {
        // console.log(data);
        // membuat variabel
        var kelas = [];
        var jumlah = [];
        // looping semua data dari response
        for (var i in data) {
          kelas.push(data[i].kelas);
          jumlah.push(data[i].jumlah);
        }
         // chart
			var ctx = document.getElementById('myChartKunjungan');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: kelas,
          datasets: [{
            label: ['Kunjungan'],
            data: jumlah,
            backgroundColor: [
              'rgb(76, 181, 245)',
              'rgb(255, 66, 14)',
              'rgb(245, 54, 54)',
              'rgb(245, 162, 54)',
              'rgb(245, 210, 54)',
              'rgb(194, 245, 54)',
              'rgb(127, 245, 54)',
              'rgb(80, 224, 250)',
              'rgb(48, 119, 207)',
              'rgb(42, 96, 163)',

              'rgb(36, 42, 237)',
              'rgb(91, 47, 194)',
              'rgb(76, 33, 176)',
              'rgb(81, 33, 176)',
              'rgb(116, 33, 176)',
              'rgb(138, 33, 176)',
              'rgb(150, 24, 148)',
              'rgb(81, 33, 176)',
              'rgb(173, 17, 116)',
              'rgb(17, 173, 98)',

              'rgb(60, 52, 99)',
              'rgb(66, 87, 23)',
              'rgb(145, 76, 16)',
              'rgb(214, 168, 129)',
              'rgb(171, 125, 85)',
              'rgb(43, 110, 55)',
              'rgb(16, 61, 24)',
              'rgb(162, 242, 177)',
              'rgb(72, 21, 74)',
              'rgb(19, 84, 148)',
              'rgb(84, 94, 196)',
            ],
        
            borderWidth: 1
          }
            
          ]

        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
          
  // end cart


        
        
    }
    // sucess

  });
}

// chart peminatan baca buku
 function peminatanBuku(){
  let url=$('.url').val();
  $.ajax({
    url: url+'Grafik/PeminatanBuku',
    method: "post",
    dataType:"json",
    success: function(data) {
        // console.log(data);
        // membuat variabel
        var kelas = [];
        var jumlah = [];
        // looping semua data dari response
        for (var i in data) {
          kelas.push(data[i].kelas);
          jumlah.push(data[i].jumlah);
        }
         // chart
			var ctx = document.getElementById('myChartPeminatan');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: kelas,
          datasets: [{
            label: ['Kunjungan'],
            data: jumlah,
            backgroundColor: [
              'rgb(76, 181, 245)',
              'rgb(255, 66, 14)',
              'rgb(245, 54, 54)',
              'rgb(245, 162, 54)',
              'rgb(245, 210, 54)',
              'rgb(194, 245, 54)',
              'rgb(127, 245, 54)',
              'rgb(80, 224, 250)',
              'rgb(48, 119, 207)',
              'rgb(42, 96, 163)',

              'rgb(36, 42, 237)',
              'rgb(91, 47, 194)',
              'rgb(76, 33, 176)',
              'rgb(81, 33, 176)',
              'rgb(116, 33, 176)',
              'rgb(138, 33, 176)',
              'rgb(150, 24, 148)',
              'rgb(81, 33, 176)',
              'rgb(173, 17, 116)',
              'rgb(17, 173, 98)',

              'rgb(60, 52, 99)',
              'rgb(66, 87, 23)',
              'rgb(145, 76, 16)',
              'rgb(214, 168, 129)',
              'rgb(171, 125, 85)',
              'rgb(43, 110, 55)',
              'rgb(16, 61, 24)',
              'rgb(162, 242, 177)',
              'rgb(72, 21, 74)',
              'rgb(19, 84, 148)',
              'rgb(84, 94, 196)',
            ],
        
            borderWidth: 1
          }
            
          ]

        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
          
  // end cart


        
        
    }
    // sucess

  });
 }






// $('.dropdown-toggle').dropdown()
$('.loading').css('top', '100%');
$('.gambar-loading').css('opacity', '0');






 
