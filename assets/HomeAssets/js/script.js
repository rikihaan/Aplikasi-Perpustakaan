$('#tglLahirSiswa').datepicker({
	altField: "#actualDate",
	defaultDate: '01-01-2005',
	dateFormat: "dd-mm-yy",
	dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	duration: "slow",
	minDate: new Date(2005, 1 - 1, 1),
	changeYear: true,
	yearRange: "2005:2010",
	changeMonth: true
})

$('#tahunLahirAyah').datepicker({
	altField: "#actualDate",
	dateFormat: "dd-mm-yy",
	dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	duration: "slow",
	changeYear: true,
	yearRange: "1945:2020",

})

$('#tahunLahirIbu').datepicker({
	altField: "#actualDate",
	dateFormat: "dd-mm-yy",
	dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	duration: "slow",
	changeYear: true,
	yearRange: "1945:2020",
})


$('#baca').click(function () {
	if ($(this).prop("checked") == true) {
		$('.lanjut').css({
			'display': 'block',
			'transition': '2s'
		})
	} else if ($(this).prop("checked") == false) {
		$('.lanjut').css({
			'display': 'none',
			'transition': '2s'
		})
	}
});


$('#SelectJalur').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();


	$.ajax({
		url: url + 'Home/getDataPendaftarByJalur',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			console.log(respon);

			$('#tablePerjalur tbody').html('');
			// $('.list-group.nipGuru').html('<h6>Daftar Guru</h6>');
			var no = 1;
			$.each(respon, function (i, v) {

				$('#tablePerjalur tbody').append(`
			<tr>
					<td>` + no++ + `</td>
					<td>	` + v.koreg + `</td>
					<td>	` + v.namaSiswa + `</td>
					<td>	` + v.namaSiswa + `</td>
					<td>	` + v.totalJarak + `</td>
					<td>	` + v.totalNilai + `</td>
					<td>
					<img src="` +
					url + `assets/HomeAssets/img/logo/` + v.statusPendaftaran + `.svg" width="15">
					</td>
			</tr>
				` + v.nama + `
					<button type="Button" data-id="` + v.id + `" class="badge badge-primary float-right mr-1 tombolAdd">Add</button>
			</li>
			`)
			})

		}


	})

})


$('#jalurPpdb').on('change', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var url = $('#url').val()
	var id = $(this).val();
	$.ajax({
		url: url + 'Home/getDataJalurPpdb',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			if (respon == null) {
				$('.loading').css('top', '100%');
				$('.gambar-loading').css('opacity', '0');
			} else {
				if (respon.inputPrestasi == 1) {
					$('.prestasi').fadeIn()
					$('.infoInputNilai').html(respon.ppdb)
					$('.nilaiP').fadeIn();
					$('#konfirmasiInputNilai').modal({
						show: true,
						backdrop: false
					});
					$('.loading').css('top', '100%');
					$('.gambar-loading').css('opacity', '0');
				} else {
					$('.prestasi').fadeOut()
					$('.bungkusKategori').fadeOut()
					$('.nilaiP').fadeOut();
					$('.loading').css('top', '100%');
					$('.gambar-loading').css('opacity', '0');
				}
			}
		}

	})
	// $('.loading').css('top', '100%');
	// $('.gambar-loading').css('opacity', '0');

})



// data tables all
var url = $('.url').val()
table = $('#table').DataTable({
	"scrollY": "350px",
	"scrollCollapse": true,
	"paging": false,
	responsive: true,

	"processing": true, //Feature control the processing indicator.
	"serverSide": true, //Feature control DataTables' server-side processing mode.
	"order": [], //Initial no order.
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": url + 'Home/dataTabelInformasi',
		"type": "POST"
	},
	"columnDefs": [{
			"targets": [-1, 0, 1, 2, 3, 4, 5],
			"className": 'text-center'
		},
		{
			"targets": [-1, 0, 1, 2, 3, 5],
			"orderable": false
		}

	]


});

// batas akhir all


// data tables jalur ppdb 1
table = $('#tablePPDB1').DataTable({
	"scrollY": "350px",
	"scrollCollapse": true,
	"paging": false,
	responsive: true,

	"processing": true, //Feature control the processing indicator.
	"serverSide": true, //Feature control DataTables' server-side processing mode.
	"order": [], //Initial no order.
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": url + 'Home/dataTabelInformasi1',
		"type": "POST"
	},
	"columnDefs": [{
			"targets": [-1, 0, 1, 2, 3, 4, 5],
			"className": 'text-center'
		},
		{
			"targets": [-1, 0, 1, 2, 3, 5],
			"orderable": false
		}

	]


});
// batas akhir jalur ppdb 1



// tabel per jalur zonasi

table = $('.tablePerjalur').DataTable({
	"scrollY": "300px",
	"scrollCollapse": true,
	"paging": false,
	responsive: true,

});
// akhir batas tabel jalur per zonasi


// get data kategori prestasi berdasarkan peyelengara
$('.nilaiPrestasi').on('change', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var url = $('.url').val()
	var id = $(this).val();
	$('#kategori').html('');
	$.ajax({
		url: url + 'Home/getDataKategoriByidPeyelengara',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.kategori').append(`	<option value="">Pilih Kategori Prestasi</option>`)
			$.each(respon, function (i, v) {
				$('.kategori').append(`
				<option value="` + v.id_satuan + `">` + v.satuan + `</option>
				`)
			})
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})

})
// batas akhir get data kategori prestasi berdasarkan peyelengara
// get data kejuaran with kategory
$('.kategori').on('change', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var url = $('.url').val()
	var id = $(this).val();
	$('#tingkat').html('');
	$.ajax({
		url: url + 'Home/getDatatingkatByidKategori',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.tingkat').append(`	<option value="">Pilih tingkat Prestasi</option>`)
			$.each(respon, function (i, v) {
				$('.tingkat').append(`
				<option value="` + v.id + `">` + v.kejuaraan + `</option>
				`)
			})
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})

})
// batas akhir get data kejuaran with kategory

// get nilai prestasi by id tingkat juara
$('.tingkat').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	$('.nilaiP').html('');
	$.ajax({
		url: url + 'Home/getDataNilaiPrestasiByIdTingkat',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			if (respon == null) {
				$('.loading').css('top', '100%');
				$('.gambar-loading').css('opacity', '0');
			} else {
				$('#scorePrestasi').val(respon.score)
				$('#idPrestasi').val(respon.id)
				$('.nilaiP').append(`
				<p>` + respon.kejuaraan + `: ` + respon.score + `</p>
				`);
				$('.loading').css('top', '100%');
				$('.gambar-loading').css('opacity', '0');
			}
		}
	})

})
// batas akhir get data kejuaran with kategory
// get data kota dengan berdasarkan provisi
$('.provinsi').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	$('#kabKota').html('');
	$.ajax({
		url: url + 'Home/getDataKotaByIdProv',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.kabKota').append(`	<option value="">Pilih Kota / Kabupaten</option>`)
			$.each(respon, function (i, v) {
				$('.kabKota').append(`
				<option value="` + v.id + `">` + v.name + `</option>
				`)
			})
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})

})
// bats akhir get data kota dengan berdasarkan provisi

// get data kecamtan dengan berdasarkan kotaKabupaten
$('.kabKota').on('change', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var url = $('.url').val()
	var id = $(this).val();
	$('#kecamatan').html('');

	$.ajax({
		url: url + 'Home/getDataKecamatanByIdKota',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.kecamatan').append(`	<option value="">Pilih Kecamatan</option>`)

			$.each(respon, function (i, v) {
				$('.kecamatan').append(`
				<option value="` + v.id + `">` + v.name + `</option>
				`)
				$('.loading').css('top', '100%');
				$('.gambar-loading').css('opacity', '0');
			})
		}
	})

})
// bats akhir get data kecamtan dengan berdasarkan kotaKabupaten
// get data desa dengan berdasarkan kecamatan
$('.kecamatan').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	$('.desa').html('');
	$.ajax({
		url: url + 'Home/getDataDesaByIdKecamatan',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.desa').append(`	<option value="">Pilih Desa</option>`)
			$.each(respon, function (i, v) {
				$('.desa').append(`
				<option value="` + v.id + `">` + v.name + `</option>
				`)
			})
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})

})
// bats akhir get data desa dengan berdasarkan kecamatan

// awal form validation
var urlKirim = $('#url').val();
$("#formFormulir").validate({
	focusInvalid: false,
	invalidHandler: function (form, validator) {
		Swal.fire({
			icon: 'error',
			title: 'Isian data belum lengkap !!!',
			text: 'Mohon Cek Kembali ',
			timer: 2000,
		})
		if (!validator.numberOfInvalids())
			return;


		$('html, body').animate({
			scrollTop: $(validator.errorList[0].element).offset().top - 190
		}, 3000);


	},
	rules: {

		kategori: {
			required: true
		},

		nilaiPrestasi: {
			required: true
		},
		namaKejuaraan: {
			required: true
		},

		nisnSiswa: {
			required: true,
			number: true,
			rangelength: [10, 10],
			remote: {
				url: urlKirim + "Home/cekNISN",
				type: "post"
			}

		},

		tingkat: {
			required: true
		},

		jalurPpdb: {
			required: true
		},
		sekolahAsal: {
			required: true
		},

		namaSiswa: {
			required: true
		},

		nikSiswa: {
			required: true,
			number: true,
			rangelength: [16, 16],
			remote: {
				url: urlKirim + "Home/cekNIK",
				type: "post"
			}

		},

		noKK: {
			required: true,
			number: true,
			rangelength: [16, 16],

		},

		noHp: {
			required: true,
			number: true,
			rangelength: [11, 13],

		},

		agama: {
			required: true,


		},

		kodePos: {
			required: true,


		},

		provinsi: {
			required: true,


		},


		tglLahirSiswa: {
			required: true
		},

		tempatLahir: {
			required: true
		},

		alamat: {
			required: true
		},

		jk: {
			required: true
		},

		npsn: {
			required: true,
			number: true,
			rangelength: [8, 8],
		},

		tinggiBadan: {
			required: true
		},

		beratBadan: {
			required: true
		},

		rt: {
			required: true
		},

		rw: {
			required: true
		},

		desa: {
			required: true
		},

		kecamatan: {
			required: true
		},

		kabKota: {
			required: true

		},

		provinsi: {
			required: true

		},

		longitude: {
			required: true,
			strongCoord: true
		},

		namaAyah: {
			required: true

		},

		nikAyah: {
			required: true,
			number: true,
			rangelength: [16, 16]

		},



		pekerjaanAyah: {
			required: true

		},

		penghasilanAyah: {
			required: true

		},

		namaibu: {
			required: true

		},

		nikIbu: {
			required: true,
			number: true,
			rangelength: [16, 16],

		},



		pekerjaanIbu: {
			required: true

		},

		penghasilanIbu: {
			required: true

		},

		tahunLahirIbu: {
			required: true

		},

		pendidikanIbu: {
			required: true

		},

		tahunLahirAyah: {
			required: true

		},

		pendidikanAyah: {
			required: true

		},

		// PAI
		paiK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		paiK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		paiK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		paiK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		paiK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		paiK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		// pkn
		pknK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		pknK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		pknK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		pknK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		pknK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		pknK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		// indonesia
		indoK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		indoK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		indoK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		indoK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		indoK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		indoK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		// mtk

		mtkK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		mtkK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		mtkK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		mtkK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		mtkK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		mtkK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		// ipa
		ipaK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		ipaK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		ipaK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		ipaK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		ipaK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		ipaK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		// ips
		ipsK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		ipsK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		ipsK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		ipsK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		ipsK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		ipsK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		// sbdp
		sbdpK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		sbdpK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		sbdpK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		sbdpK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		sbdpK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		sbdpK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		// pjok
		pjokK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		pjokK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		pjokK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		pjokK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},
		pjokK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		pjokK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		// sunda

		sundaK4S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100

		},

		sundaK4S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		sundaK5S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		sundaK5S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
		sundaK6S1: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},

		sundaK6S2: {
			required: true,
			rangelength: [2, 3],
			number: true,
			max: 100
		},
	},
	messages: {
		kategori: {
			required: 'Kategori Belum di pilih'
		},
		nilaiPrestasi: {
			required: 'Peyelengara belum di pilih'
		},
		namaKejuaraan: {
			required: 'Nama Kejuaran Harus di isi'
		},

		tingkat: {
			required: 'Tingkat Belum di pilih'
		},
		jalurPpdb: {
			required: ' Jalur PPDB  belum di pilih'
		},
		sekolahAsal: {
			required: ' Sekolah Asal Harus diisi'
		},

		namaSiswa: {
			required: 'Nama wajib  diisi !'
		},

		tglLahirSiswa: {
			required: 'Tanggal lahir wajib di isi'
		},

		tempatLahir: {
			required: 'tempat lahir wajib di isi'
		},

		nikSiswa: {
			required: 'NIK wajib  diisi !',
			number: 'Hanya boleh angka ',
			rangelength: 'NIK Harus 16 digit',
			remote: 'NIK SUDAH TERDAFTAR !'

		},

		noKK: {
			required: 'No KK wajib  diisi !',
			number: 'Hanya boleh angka ',
			rangelength: 'No KK Harus 16 digit',

		},

		npsn: {
			required: 'NPSN wajib  diisi !',
			number: 'NPSN Hanya Boleh Number',
			rangelength: 'NPSN Harus 8 digit',
		},

		tinggiBadan: {
			required: 'Tinggi badan wajib  diisi !'
		},

		longitude: {
			required: 'Longitude wajib  diisi !'
		},

		provinsi: {
			required: 'provinsi belum dipilih'

		},

		beratBadan: {
			required: 'Berat badan wajib di isi'
		},

		jk: {
			required: 'Harus diisi !'
		},

		nisnSiswa: {
			required: 'NISN Wajib di isi !',
			remote: 'NISN Sudah Terdaftar',
			number: 'NISN Hanya Boleh Number',
			rangelength: 'NISN Harus 10 digit',
			remote: 'NISN SUDAH TERDAFTAR !!!'


		},

		noHp: {
			required: 'No Hp Harus Di Isi',
			number: 'Hanya Angka',
			rangelength: 'min-11 max-13 digit',

		},

		kodePos: {
			required: 'Kode Harus Di isi',
		},

		alamat: {
			required: 'alamat Wajib di isi !'
		},

		rt: {
			required: 'Rt harus diisi !'
		},

		rw: {
			required: 'Rw harus diisi !'
		},

		desa: {
			required: 'Desa harus diisi !'
		},

		kecamatan: {
			required: 'Kecamatan harus diisi !'
		},

		kabKota: {
			required: 'Kota/Kabupaten harus diisi !'

		},


		namaAyah: {
			required: 'Nama Ayah harus diisi !'

		},
		nikAyah: {
			required: 'NIK Ayah harus diisi',
			number: 'Hanya boleh angka ',
			rangelength: 'NIK Harus 16 digit'
		},
		pekerjaanAyah: {
			required: 'Pekerjaan Belum dipilih'
		},

		penghasilanAyah: {
			required: 'Penghasilan Ayah Belum dipilih'
		},

		namaibu: {
			required: 'Nama Ibu harus diisi !'

		},
		nikIbu: {
			required: 'NIK Ibu harus diisi',
			number: 'Hanya boleh angka ',
			rangelength: 'NIK Harus 16 digit',
		},
		pekerjaanIbu: {
			required: 'Pekerjaan belum di pilih'
		},
		penghasilanIbu: {
			required: 'Penghasilan belum dipilih'
		},

		tahunLahirIbu: {
			required: 'Wajib Diisi'
		},

		pendidikanIbu: {
			required: 'pendidikan belum dipilih'
		},

		tahunLahirAyah: {
			required: 'Wajib Diisi'
		},

		pendidikanAyah: {
			required: 'Wajib Diisi'
		},

		agama: {
			required: 'Agama Belum dipilih',
		},

		pekerjaanIbu: {
			required: 'Pekerjaan Belum dipilih'
		},

		penghasilanIbu: {
			required: 'Penghasilan Ibu Belum dipilih'
		},
		// validasi nilai
		// PAI
		paiK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		paiK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		paiK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		paiK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		paiK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		paiK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		// pkn
		pknK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		pknK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		pknK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		pknK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		pknK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		pknK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		// indo
		indoK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		indoK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		indoK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		indoK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		indoK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		indoK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		// mtk
		mtkK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		mtkK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		mtkK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		mtkK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		mtkK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		mtkK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		// ipa
		ipaK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipaK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipaK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipaK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipaK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipaK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		// ips
		ipsK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipsK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'


		},
		ipsK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipsK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		ipsK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		ipsK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		// sbdp
		sbdpK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},

		sbdpK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		sbdpK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		sbdpK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'

		},
		sbdpK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},

		sbdpK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		// pjok
		pjokK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		pjokK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		pjokK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		pjokK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		pjokK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		pjokK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		// sunda
		sundaK4S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		sundaK4S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		sundaK5S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		sundaK5S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		sundaK6S1: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		sundaK6S2: {
			required: 'Wajib diisi',
			rangelength: 'min 2 max 3 digit',
			number: 'Hanya Number',
			max: 'max Nilai 100'
		},
		// batas Akhir Number
	}
});

// custum method
$.validator.addMethod('strongCoord', function (value, element) {
	return this.optional(element) ||
		(value.length >= 4 &&
			/^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$/.test(value));
}, 'Longitude tidak valid\'.')
// akhir form validation
// kirim formulir
$('#daftarForm').on('click', function (e) {
	e.preventDefault();
	Swal.fire({
		title: 'Anda Yakin Kirim Formulir?',
		text: "Data yang anda kirim tidak bisa di ubah kembali",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Kirim Formulir'
	}).then((result) => {
		if (result.value) {
			$('#formFormulir').submit();
			// 	Swal.fire(
			// 		'Terkirim!',
			// 		'Data pendaftran anda terkirim',
			// 		'success'
			// 	)
		}
	})

});
// input cek data pendaftar
$('.inputcekdata').on('keypress', function (e) {
	var url = $('.url').val();
	var key = $(this).val()
	if (e.which == 13) {
		$('.loading').css('top', `0`);
		$('.gambar-loading').css('opacity', '1')
		$('.hasil-cekdata').html('')
		$('.hasil-cekdata2').html('')
		$('.inputcekdata').val('')
		$.ajax({
			url: url + 'Home/cekDataPendaftar',
			data: {
				key: key
			},
			method: 'post',
			dataType: 'json',
			success: function (respon) {
				// console.log(respon)
				if (respon == 2) {
					Swal.fire({
						icon: 'error',
						title: 'Maaf ..',
						text: 'Data yang anda cari tidak ada!! mohon periksa kembali inputan anda',
					})
					$('.loading').css('top', `100%`);
					$('.gambar-loading').css('opacity', '0')
				} else {
					// nilai prestasi 
					if (respon.idPrestasi > 0) {
						$('.hasil-cekdata2').append(`
						<table class="table table-sm">
							<tr>
								<td>Score Prestasi</td>
								<td>:</td>
								<td>` + respon.nilaiPrestasi + `</td>
							</tr>
						</table>
						`);
					}
					// mulai ajax 2
					$.ajax({
						url: url + 'Home/getDataUrlByIdJalur',
						data: {
							id: respon.id_jalur
						},
						dataType: 'json',
						method: 'post',
						success: function (respon2) {
							// jika pendaftar belum verifikasi
							if (respon.statusPendaftaran == 1) {
								$('.hasil-cekdata2').append(`
								<table class="table table-sm">
								<tr>
										<td>Jumlah Pendaftar</td>
										<td>:</td>
										<td>` + respon2.jumlahDaftar + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Pendaftar Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.terVerifikasi + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Belum Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.belumVErifikasi + ` Orang</td>
								</tr>
								<tr>
								<td>Pindah / Cabut Berkas</td>
								<td>:</td>
								<td>` + respon2.pindah + ` Orang</td>
								</tr>
								<tr>
									<td>Quota Pendaftaran </td>
									<td>:</td>
									<td>` + respon.quota + ` Orang</td>
								</tr>
								</table>
								<p class="text-danger">* Data Belum Terverifikasi</p>
								`);
							}
							// jika setatus pindah
							else if (respon.statusPendaftaran == 3) {
								$('.hasil-cekdata2').append(`<h1 class="text-danger">Pindah / Cabut Berkas</h1>`);
							}
							// jika sudah verifikasi
							else {
								// jika status lulus
								if (respon.lulus == 4) {
									$('.hasil-cekdata2').append(`
								<table class="table table-sm">
								<tr>
										<td>Jumlah Pendaftar</td>
										<td>:</td>
										<td>` + respon2.jumlahDaftar + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Pendaftar Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.terVerifikasi + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Belum Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.belumVErifikasi + ` Orang</td>
								</tr>
								<tr>
								<td>Pindah / Cabut Berkas</td>
								<td>:</td>
								<td>` + respon2.pindah + ` Orang</td>
								</tr>
								<tr>
									<td>Peringkat</td>
									<td>:</td>
									<td>Ke- ` + respon.rank + `</td>
								</tr>
								<tr>
									<td>Quota Pendaftaran </td>
									<td>:</td>
									<td>` + respon.quota + ` Orang</td>
								</tr>
								</table>
								<h4 class="text-success">SELAMAT ANDA DITERIMA</h4>
								<p>Surat keterangan diterima dapat di ambil di panitia, bagi yang mendaftar kolektif bisa di ambil di sekolah masing-masing</p>
								`)
								}

								// jika tidak lulus
								else if (respon.lulus == 5) {
									$('.hasil-cekdata2').append(`
									<table class="table table-sm">
									<tr>
											<td>Jumlah Pendaftar</td>
											<td>:</td>
											<td>` + respon2.jumlahDaftar + ` Orang</td>
									</tr>
									<tr>
										<td>Jumlah Pendaftar Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.terVerifikasi + ` Orang</td>
									</tr>
									<tr>
										<td>Jumlah Belum Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.belumVErifikasi + ` Orang</td>
									</tr>
									<tr>
									<td>Pindah / Cabut Berkas</td>
									<td>:</td>
									<td>` + respon2.pindah + ` Orang</td>
									</tr>
									<tr>
										<td>Peringkat</td>
										<td>:</td>
										<td>Ke- ` + respon.rank + `</td>
									</tr>
									<tr>
										<td>Quota Pendaftaran </td>
										<td>:</td>
										<td>` + respon.quota + ` Orang</td>
									</tr>
									</table>
									<h4 class="text-info">Maaf anda tidak diterima !!!</h4>
									<p>Surat keterangan tidak diterima dapat di ambil di panitia, bagi yang mendaftar kolektif bisa di ambil di sekolah masing-masing</p>
									`)
								}

								// data terverifikasi
								else {
									$('.hasil-cekdata2').append(`
								<table class="table table-sm">
								<tr>
										<td>Jumlah Pendaftar</td>
										<td>:</td>
										<td>` + respon2.jumlahDaftar + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Pendaftar Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.terVerifikasi + ` Orang</td>
								</tr>
								<tr>
										<td>Jumlah Belum Terverifikasi</td>
										<td>:</td>
										<td>` + respon2.belumVErifikasi + ` Orang</td>
								</tr>
								<tr>
									<td>Pindah / Cabut Berkas</td>
									<td>:</td>
									<td>` + respon2.pindah + ` Orang</td>
								</tr>
								<tr>
									<td>Peringkat Sementara</td>
									<td>:</td>
									<td>Ke- ` + respon.rank + `</td>
								</tr>
								<tr>
									<td>Quota Pendaftaran </td>
									<td>:</td>
									<td>` + respon.quota + ` Orang</td>
								</tr>
								</table>
								<p class="text-danger">* Data yang tertera disini belum final selama pendaftaran belum berakhir/tutup dari tanggal yg telah di tentukan</p>
								`)
								}
							}
						}
					})
					// akhir ajax2
					$('.hasil-cekdata').fadeIn();
					Swal.fire({
						icon: 'success',
						title: 'Data ID ' + respon.koreg,
						text: 'Ditemukan ',
					})
					var statusDaftar = "";
					if (respon.statusPendaftaran == 3) {
						statusDaftar = "Pindah / Cabut Berkas"
					} else if (respon.statusPendaftaran == 1) {
						statusDaftar = "Belum Verifikasi"
					} else if (respon.lulus == 4) {
						statusDaftar = "Diterima"
					} else if (respon.lulus == 5) {
						statusDaftar = "Tidak Diterima"
					} else {
						statusDaftar = "Terverifikasi"
					}
					$('.hasil-cekdata').append(`
					<h6>Data Pendaftar</h6>
					<table class="table table-sm">
					<tr>
						<td>Calon Peserta Didik</td>
						<td>:</td>
						<td>` + respon.nama + `</td>
					</tr>
					<tr>
						<td>No. Registrasi</td>
						<td>:</td>
						<td>` + respon.koreg + `</td>
					</tr>
					<tr>
					<td>No. Urut Daftar</td>
					<td>:</td>
					<td>` + respon.noUrut + `</td>
				</tr>
					<tr>
					<td>Asal Sekolah</td>
					<td>:</td>
					<td>` + respon.sekolah + `</td>
					</tr>
				
					
					<tr>
						<td>Score Jarak</td>
						<td>:</td>
						<td>` + respon.jarak + ` meter</td>
					</tr>
					
					<tr>
						<td>Jumlah Nilai</td>
						<td>:</td>
						<td>` + respon.nilai + ` </td>
					</tr>
					<tr>
						<td>Rata-Rata Nilai</td>
						<td>:</td>
						<td>` + respon.rataRata + ` </td>
					</tr>
					<tr>
						<td>Jumlah Rata-Rata Nilai</td>
						<td>:</td>
						<td>` + respon.jumlahRataRata + ` </td>
					</tr>
					<tr>
					<td>Usia</td>
					<td>:</td>
					<td>` + respon.usia + ` Tahun </td>
					</tr>
					<tr>
						<td>Jalur PPDB</td>
						<td>:</td>
						<td>` + respon.ppdb + `</td>
					</tr>
					<tr>
					<td>Status Pendaftaran</td>
					<td>:</td>
					<td>` + statusDaftar + `</td>
				</tr>
					</table>
					`);
					$('.loading').css('top', `100%`);
					$('.gambar-loading').css('opacity', '0')
				}
			}
		})
	}

})

$('#setujuDaftar').click(function () {
	if ($(this).prop("checked") == true) {
		$('.daftarForm').fadeIn()
	} else if ($(this).prop("checked") == false) {
		$('.daftarForm').fadeOut()
	}
});

// tombol-Baca
$('.tombol-baca').on('click', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var url = $('.url').val();
	var id = $(this).data('id');
	$('.pengumumanTitle').html('')
	$('.deskripsiPengumuman').html('');
	$('#pengumuman').modal('show');
	$.ajax({
		url: url + 'Home/bacaInfo',
		method: 'post',
		data: {
			id: id
		},
		dataType: 'json',
		success: function (datares) {
			$('.pengumumanTitle').append(datares.title)
			$('.deskripsiPengumuman').append(datares.deskripsi);
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})
})

// alert form
var formalert = $('.formalert').data('formalert');
if (formalert) {

	if (formalert == "Gagal") {
		Swal.fire({
			icon: 'error',
			title: 'Pendaftaran anda ',
			text: formalert + ' ! Periksa Kembali formulir inputan anda',
		})
	} else {
		Swal.fire({
			icon: 'success',
			title: 'Pendaftaran anda ',
			text: formalert + ' !',
		})
	}
}

// loading
$('.loading').css('top', '100%');
$('.gambar-loading').css('opacity', '0');
// $(document).ready(function () {
// 	$('.loading').css('display', 'none');

// })
