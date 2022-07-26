$(document).ready(function(){
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
  });

// Swal.fire({
//     position: 'top',
//     icon: 'success',
//     title: 'Your work has been saved',
//     showConfirmButton: false,
//     timer: 1500,
    
//   });

// function login data user
$(".form-login #loginUser").keyup(function(e){
    if(e.keyCode == 13)
    {
      $(this).val('');
      $('#modalUser').modal('show')
    }
  });
// end login data user

// buku Tamu

$('.labelBukuTamu').on('click', function(){
   let cekClass = $(this).hasClass('tbl-clik');
    if(cekClass == true){
      $(this).removeClass('tbl-clik')
    }
    else if(cekClass==false){
      $(this).addClass('tbl-clik')
    }
})

$('.form-buku-tamu').submit(function(e){
  e.preventDefault()
  let data =$(this).serialize();
  if(data== ''){
    alert('kosong')
  } 
  else{
    alert('ok')

  }
})

// end buku Tamu
$('.loading').css('top', '100%');
$('.gambar-loading').css('opacity', '0');

// cart js
var ctx = document.getElementById('myChart');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus','September','Oktober','November'],
        datasets: [
          {
            label: 'Membaca',
            backgroundColor: 'rgb(76, 181, 245)',
            borderColor: 'rgb(76, 181, 245)',
            data: [3, 10, 5, 2, 20, 30, 45,60,78,68,60]
          },
          {
            label: 'Peminjaman Buku',
            backgroundColor: 'rgb(255, 66, 14)',
            borderColor: 'rgb(255, 66, 14)',
            data: [4, 20, 14, 56, 40, 64, 40,72,70,50,70]
          }, 
          {
            label: 'Pengembalian',
            backgroundColor: 'rgb(27, 20, 219)',
            borderColor: 'rgb(27, 20, 219)',
            data: [9, 25, 26, 40, 55, 74, 45,82,78,68,90]
          }
      ]
    },

    // Configuration options go here
    options: {}
});
// end cart js



 
