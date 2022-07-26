var pathname = window.location.pathname;
var exsploade = pathname.split("/");
if (exsploade[3] == "Informasi") {
	CKEDITOR.replace('deskripsi');
} else if ((exsploade[3] == "informasi")) {
	CKEDITOR.replace('deskripsi');

} else if ((exsploade[2] == "informasi")) {
	CKEDITOR.replace('deskripsi');

} else if ((exsploade[2] == "Informasi")) {
	CKEDITOR.replace('deskripsi');

}
// const startTime = performance.now(); 
// console.log(startTime);
$('.tanggalLahir').datepicker({
	defaultDate: '01-01-2005',
	altField: "#actualDate",
	dateFormat: "dd-mm-yy",
	dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	duration: "slow",
	minDate: new Date(2005, 1 - 1, 1),
	changeYear: true,
	yearRange: "2005:2008",
	changeMonth: true
});
$('.ui-datepicker').addClass('notranslate');
$('#tanggakKelulusan').datepicker({
	altField: "#actualDate",
	dateFormat: "dd-mm-yy",
	dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	duration: "slow",
	changeYear: true,
	changeMonth: true
})

$('.edit').on('click', function () {
	$('.input-hidden').fadeOut();
	var id = $(this).data('id');
	var base_url = $('#url').val() + 'setting/getDataUser';
	var base_url2 = $('#url').val() + 'setting/editUser';
	$('#formUser').attr('action', base_url2);
	$.ajax({
		url: base_url,
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			// console.log(respon.id)
			$('#idUser').val(respon.id);
			$('#namaUser').val(respon.name);
			$('#emailUser').val(respon.email);
			$('#emailUser').attr('readonly', 'readonly');
			$('#userAkses').val(respon.role_id);
			// $('#status').val(respon.role_id);
		}

	})
})

$('#tambahUser').on('click', function () {
	// $('#emailUser').val(respon.email).removeAttr('readonly');
	$('#emailUser').removeAttr('readonly', 'readonly');
	var base_url = $('#url').val() + 'setting/tambahUser';
	$('.input-hidden').fadeIn();
	$('#formUser')[0].reset();
	$('#formUser').attr('action', base_url);
})

// edit data persyaratan
$('.tombolEdit').on('click', function () {
	$('.modal-title').html('Edit Persyaratan');
	var id = $(this).data('id');
	var base_url = $('#url').val() + 'ppdb/edit';
	var base_url2 = $('#url').val() + 'ppdb/editProses';
	$('#formUser').attr('action', base_url2);
	$.ajax({
		url: base_url,
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			$('#syaratPpdb').val(respon.persyaratan);
			$('#jalurPpdb').val(respon.id_jalur);
			$('#idSyarat').val(respon.id);
		}
	})
})

$('.tombolTambah').on('click', function () {
	$('.modal-title').html('Tambah Persyaratan');
	var base_url = $('#url').val() + 'ppdb';
	$('#formUser')[0].reset();
	$('#formUser').attr('action', base_url);
})



// edit data jalur ppdb

$('.tombolEditJalur').on('click', function () {
	$('.modal-title').html('Edit Jalur PPDB');
	var id = $(this).data('id');
	var base_url = $('#url').val() + 'ppdb/getJalurByid';
	var base_url2 = $('#url').val() + 'ppdb/editJalurPpdb';
	$('.modal-footer button[type=submit]').html('edit')
	$('#formUser').attr('action', base_url2);
	$.ajax({
		url: base_url,
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			$('#jalurPpdb').val(respon.ppdb);
			$('#quota').val(respon.quota);
			$('#input-nilai').val(respon.input_nilai);
			$('#inputPrestasi').val(respon.inputPrestasi);
			$('#statusAktif').val(respon.statusAktif);
			$('#idJalur').val(respon.id);
		}
	})
})


$('.tombolTambahJalur').on('click', function () {
	$('.modal-title').html('Tambah Jalur PPDB');
	$('.modal-footer button[type=submit]').html('simpan')
	var base_url = $('#url').val() + 'ppdb/jalurPPDB';
	$('#formUser')[0].reset();
	$('#formUser').attr('action', base_url);
})


// edit Nilai Prestasi nonakademik
$('.tombolEditPrestasi').on('click', function () {
	$('.modal-title').html('Edit Score Nilai Nonakademik');
	var id = $(this).data('id');
	var base_url = $('#url').val() + 'ppdb/getDataPrestasi';
	var base_url2 = $('#url').val() + 'ppdb/editNilaiPrestasi';
	var base_url3 = $('#url').val() + 'ppdb/getDataKatSatuan';
	$('.modal-footer button[type=submit]').html('edit')
	$('#formUser').attr('action', base_url2);
	$.ajax({
		url: base_url,
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			$('#kategori').html('');
			// get data satuan 
			$.ajax({
				url: base_url3,
				data: {
					id: respon.id_satuan
				},
				method: 'post',
				dataType: 'json',
				success: function (respon2) {
					$('#penyelengara').val(respon2.id_penyelengara);
					$('#kategori').append(`<option value="` + respon2.id_satuan + `">` + respon2.satuan + `</option>`);
				}
			})
			$('#tingkat').val(respon.kejuaraan);
			$('#nilaiPrestasi').val(respon.score);
			$('#idPrestasi').val(respon.id);
		}
	})
})


$('.tombolTambahPrestasi').on('click', function () {
	$('#kategori').html('');
	$('.modal-title').html('Tambah Nilai Nonakademik');
	$('.modal-footer button[type=submit]').html('simpan')
	var base_url = $('#url').val() + 'ppdb/nonAkademik';
	$('#formUser')[0].reset();
	$('#formUser').attr('action', base_url);
})
// batas akhir edit prestasi
// edit informasi
// CKEDITOR.replace('deskripsi');

$('.tombolEditInformasi').on('click', function () {
	// CKEDITOR.replace('deskripsi');

	$('.modal-title').html('Edit Informasi');
	var id = $(this).data('id');
	var base_url = $('#url').val() + 'ppdb/getInformasiByid';
	var base_url2 = $('#url').val() + 'ppdb/editInformasi';
	$('.modal-footer button[type=submit]').html('edit')
	$('#formUser').attr('action', base_url2);
	$.ajax({
		url: base_url,
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			// console.log(respon)
			$('#titleInformasi').val(respon.title);
			// $('.deskripsi').val(respon.deskripsi);
			CKEDITOR.instances['deskripsi'].setData(respon.deskripsi)
			$('#idInformasi').val(respon.id);
			if (respon.is_headline == 1) {
				$('#jumboTron1').attr('checked', 'checked');
			} else if (respon.is_headline == 2) {
				$('#jumboTron2').attr('checked', 'checked');
			}
		}
	})
})

$('.tombolTambahInformasi').on('click', function () {
	CKEDITOR.instances['deskripsi'].setData('')
	$('.modal-title').html('Tambah Informasi');
	// cekeditor
	$('.modal-footer button[type=submit]').html('simpan')
	var base_url = $('#url').val() + 'ppdb/informasi';
	$('#formUser')[0].reset();
	$('#formUser').attr('action', base_url);
})
// console.log(CKEDITOR)
// aktif nonaktif form
$('#formAktif').on('click', function () {
	var nilai = $(this).val();
	var url = $('#url').val();
	$.ajax({
		url: url + 'Setting/aktifForm',
		method: 'post',
		data: {
			id: 1
		},
		success: function (respon) {
			alert(respon)
		}
	})
})
// batas akhir edit informasi
$('.card-body').on('click', '.viewPendaftar', function () {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	var koreg = $(this).data('koreg');
	var id = $(this).data('id');
	var url = $('.url').val()
	$.ajax({
		url: url + 'Admin/getDataPendaftarById',
		method: 'POST',
		data: {
			id: id,
			koreg: koreg
		},
		dataType: 'json',
		success: function (respon) {
			// 
			if (respon.statusPendaftaran == 1) {
				$('#ver1').attr('checked', 'checked')
			} else if (respon.statusPendaftaran == 2) {
				$('#ver2').attr('checked', 'checked')

			} else {
				$('#ver3').attr('checked', 'checked')
			}
			$('#koreg').val(respon.koreg)
			$('#nama').val(respon.namaSiswa)
			$('#nisn').val(respon.nisnSiswa)
			$('#sekolah').val(respon.asalSekolah)
			$('#nilaiPrestasiPraktek').val(respon.nilaiPraktekPrestasi)
			$('#cabangPrestasi').val(respon.cabangPrestasi)
			$('#npsn').val(respon.npsnSekolah)
			$('#JalurPPDB').val(respon.id_jalur)
			$('#tingkat2').val(respon.idPrestasi)
			$('#nilaiJarak').val(respon.totalJarak)
			$('#nilaiPrestasi').val(respon.nilaiPrestasi)
			$('#totalNilai').val(respon.totalNilai)
			$('#latitude').val(respon.latitude)
			$('#longitude').val(respon.longitude)
			$('#rataRataNilai').val(respon.rataRataTotalNilai)
			$('#idDaftar').val(respon.id)
			$('#koregSen').val(respon.koreg)
			$('.inputNilaiPraktek').val(respon.nilaiPraktekPrestasi)
			$('#totalRataRata').val(respon.jumlahRataRata)
			$('#tempatLahir').val(respon.tempatLahirSiswa)
			$('#tanggalLahir').val(respon.tanggalLahirSiswa)
			$('#usiaSiswa').val(respon.usiaSiswa)

			// buat apdate nilai prkatek
			$('#idEdit').val(respon.id)
			$('#koregEdit').val(respon.koreg)
			// nilai pai
			$('#paiK4S1').val(respon.paiK4S1)
			$('#paiK4S2').val(respon.paiK4S2)
			$('#paiK5S1').val(respon.paiK5S1)
			$('#paiK5S2').val(respon.paiK5S2)
			$('#paiK6S1').val(respon.paiK6S1)
			$('#paiK6S2').val(respon.paiK6S2)
			// batas Nilai pai

			// nilai pkn
			$('#pknK4S1').val(respon.pknK4S1)
			$('#pknK4S2').val(respon.pknK4S2)
			$('#pknK5S1').val(respon.pknK5S1)
			$('#pknK5S2').val(respon.pknK5S2)
			$('#pknK6S1').val(respon.pknK6S1)
			$('#pknK6S2').val(respon.pknK6S2)
			// batas Nilai pkn

			// nilai indo
			$('#indoK4S1').val(respon.indoK4S1)
			$('#indoK4S2').val(respon.indoK4S2)
			$('#indoK5S1').val(respon.indoK5S1)
			$('#indoK5S2').val(respon.indoK5S2)
			$('#indoK6S1').val(respon.indoK6S1)
			$('#indoK6S2').val(respon.indoK6S2)
			// batas Nilai indo


			// nilai mtk
			$('#mtkK4S1').val(respon.mtkK4S1)
			$('#mtkK4S2').val(respon.mtkK4S2)
			$('#mtkK5S1').val(respon.mtkK5S1)
			$('#mtkK5S2').val(respon.mtkK5S2)
			$('#mtkK6S1').val(respon.mtkK6S1)
			$('#mtkK6S2').val(respon.mtkK6S2)
			// batas Nilai mtk

			// nilai ipa
			$('#ipaK4S1').val(respon.ipaK4S1)
			$('#ipaK4S2').val(respon.ipaK4S2)
			$('#ipaK5S1').val(respon.ipaK5S1)
			$('#ipaK5S2').val(respon.ipaK5S2)
			$('#ipaK6S1').val(respon.ipaK6S1)
			$('#ipaK6S2').val(respon.ipaK6S2)
			// batas Nilai ipa


			// nilai ips
			$('#ipsK4S1').val(respon.ipsK4S1)
			$('#ipsK4S2').val(respon.ipsK4S2)
			$('#ipsK5S1').val(respon.ipsK5S1)
			$('#ipsK5S2').val(respon.ipsK5S2)
			$('#ipsK6S1').val(respon.ipsK6S1)
			$('#ipsK6S2').val(respon.ipsK6S2)
			// batas Nilai ips

			// nilai sbdp
			$('#sbdpK4S1').val(respon.sbdpK4S1)
			$('#sbdpK4S2').val(respon.sbdpK4S2)
			$('#sbdpK5S1').val(respon.sbdpK5S1)
			$('#sbdpK5S2').val(respon.sbdpK5S2)
			$('#sbdpK6S1').val(respon.sbdpK6S1)
			$('#sbdpK6S2').val(respon.sbdpK6S2)
			// batas Nilai sbdp


			// nilai pjok
			$('#pjokK4S1').val(respon.pjokK4S1)
			$('#pjokK4S2').val(respon.pjokK4S2)
			$('#pjokK5S1').val(respon.pjokK5S1)
			$('#pjokK5S2').val(respon.pjokK5S2)
			$('#pjokK6S1').val(respon.pjokK6S1)
			$('#pjokK6S2').val(respon.pjokK6S2)
			// batas Nilai pjok

			// nilai sunda
			$('#sundaK4S1').val(respon.sundaK4S1)
			$('#sundaK4S2').val(respon.sundaK4S2)
			$('#sundaK5S1').val(respon.sundaK5S1)
			$('#sundaK5S2').val(respon.sundaK5S2)
			$('#sundaK6S1').val(respon.sundaK6S1)
			$('#sundaK6S2').val(respon.sundaK6S2)
			// batas Nilai sunda
			$('.tombol-cetak-verifikasi').addClass('d-none');
			$('.modalPendaftar').modal({
				'show': true,
				'backdrop': false
			})
			if (respon.idPrestasi > 0) {
				$.ajax({
					url: url + 'Admin/getDataPrestasiByIdDaftar',
					method: 'POST',
					data: {
						id: respon.idPrestasi,
						koreg: koreg
					},
					dataType: 'json',
					success: function (respon2) {
						$('.jalurAkademikNonakademik').html(``);
						if (respon2 == null) {
							$('.jalurAkademikNonakademik').append(``);
						}
						$('.jalurAkademikNonakademik').append(`
					<p class="text-warning">Tabel ini akan muncul bagi pendaftar jalur Prestasi Loba Akademik dan Non Akademik</p>
							<table class="table table-sm">
								<tr>
									<td>Penyelengara</td>
									<td>:</td>
									<td>` + respon2.peyelengara + `</td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td>` + respon2.satuan + `</td>
								</tr>
								<tr>
									<td>Kejuaraan</td>
									<td>:</td>
									<td>` + respon2.kejuaraan + `</td>
								</tr>
								<tr>
								<td>Score</td>
								<td>:</td>
								<td>` + respon2.score + `</td>
							</tr>
							</table>
					<p class="text-danger">Jika ingin merubah nilai di atas silahkan seting pada select box dibawah ini</p>

					`)
					}
				})
			}
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})
	// loading end

})

// batas akhir get data pendaftar

// update nilai praktek

$('.tombolMinus').on('click', function () {
	var idEdit = $('#idEdit').val();
	var koregEdit = $('#koregEdit').val();
	var url = $('.url').val()
	var nilai = $('.inputNilaiPraktek').val()
	$.ajax({
		data: {
			id: idEdit,
			koreg: koregEdit,
			nilai: nilai
		},
		url: url + 'Admin/EditMinusNilaiPraktek',
		method: 'post',
		dataType: 'json',
		success: function (respon) {
			$('.nilaiPrestasiPraktek').val(respon.nilaiPraktekPrestasi)
			$('.nilaiPrestasi').val(respon.nilaiPrestasi)
			$('.inputNilaiPraktek').val(respon.nilaiPraktekPrestasi)


		}
	})
})

$('.tombolPlus').on('click', function () {
	var idEdit = $('#idEdit').val();
	var koregEdit = $('#koregEdit').val();
	var url = $('.url').val()
	var nilai = $('.inputNilaiPraktek').val()
	$.ajax({
		data: {
			id: idEdit,
			koreg: koregEdit,
			nilai: nilai
		},
		url: url + 'Admin/EditMinusNilaiPraktekPlus',
		method: 'post',
		dataType: 'json',
		success: function (respon) {

			$('.nilaiPrestasiPraktek').val(respon.nilaiPraktekPrestasi)
			$('.nilaiPrestasi').val(respon.nilaiPrestasi)
			$('.inputNilaiPraktek').val(respon.nilaiPraktekPrestasi)


		}
	})
})

// batas akhir update nilai praktek


// ubah score prestasi nonakademik
$('#prestasi').on('change', function () {
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

			// if (respon == null) {
			// 	$('#nilaiPrestasi').val('');

			// } else {
			// 	$('#nilaiPrestasi').val(respon.score);
			// }
		}
	})

})
// get data kejuaran with kategory
$('.kategori').on('change', function () {
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
		}
	})

})
// batas akhir get data kejuaran with kategory
// get nilai prestasi by id tingkat juara
$('.tingkat').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();
	$('.nilaiP').html('');
	$.ajax({
		url: url + 'Home/getDataNilaiPrestasiByIdTingkat',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('#nilaiPrestasi').val(respon.score)
			// $('#idPrestasi').val(respon.id)
		}
	})
})
// batas akhir get data kejuaran with kategory
// ajax untuk score non akademik
// get data kategori perorangan // groeup dengan id peyelengara
$('.penyelengara').on('change', function () {
	var url = $('.url').val()
	var id = $(this).val();
	$('.kategori').html('');
	$.ajax({
		url: url + 'Ppdb/getDataKategoriByIdPeyelengara',
		data: {
			id: id
		},
		dataType: 'json',
		method: 'post',
		success: function (respon) {
			$('.kategori').append(`	<option value="">Pilih Kategori</option>`)
			$.each(respon, function (i, v) {
				$('.kategori').append(`
				<option value="` + v.id_satuan + `">` + v.satuan + `</option>
				`)
			})
		}
	})

})
// bats akhir ajax untuk score non akademik
$(document).ready(function () {
	// data tables
	var url = $('.url').val()
	var verifikasiTabel = $('#pendaftar').DataTable({
		"scrollY": "350px",
		"scrollCollapse": true,
		"paging": true,
		"searching": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": url + 'Admin/get_ajax',
			"type": "POST"
		},

		"columnDefs": [{

				"targets": [0, 2, 3, -1],
				"orderable": false
			}

		]
	});

	// verifikasi data dengan ajax
	$('.tombolsave').on('click', function () {
		$('.loading').css('top', '0');
		$('.gambar-loading').css('opacity', '1');
		var formV = $('.formVerifikasi').serialize()
		var url = $('.url').val()
		$.ajax({
			url: url + 'Admin/verifiksai',
			dataType: 'json',
			data: formV,
			method: 'post',
			success: function (result) {
				if (result.pesan == false) {
					Swal.fire({
						icon: 'Sukses',
						title: 'Data Tesimpan',
						text: ''
					})
					$('.jmlPendaftar').html('')
					$('.jmlVerifikasi').html('')
					$('.jmlProses').html('')
					$('.jmlCabut').html('')
					statistik();
					$('.tombol-cetak-verifikasi').removeClass('d-none');
					$('.tombol-cetak-verifikasi').attr('href', url + 'admin/cetakBuktiVerifikasi/' + result.koreg);
					$('.loading').css('top', '100%');
					$('.gambar-loading').css('opacity', '0');
				} else {
					viewUlangPendaftar(result.koreg, result.id, url);
					Swal.fire({
						icon: 'success',
						title: 'Perubahan Data Pendaftar',
						text: 'Tersimpan !!'
					})
					$('.jmlPendaftar').html('')
					$('.jmlVerifikasi').html('')
					$('.jmlProses').html('')
					$('.jmlCabut').html('')
					statistik();
					$('.tombol-cetak-verifikasi').removeClass('d-none');
					$('.tombol-cetak-verifikasi').attr('href', url + 'admin/cetakBuktiVerifikasi/' + result.koreg);
					verifikasiTabel.ajax.reload();
					// untuk yang sudah
					tabelVerifikasi.ajax.reload();
				}
			}
		})
	})

	// data tables untuk table verifikasi
	var tabelVerifikasi = $('#tabelVerifikasi').DataTable({
		"scrollY": "450px",
		"scrollCollapse": true,
		"paging": true,
		"searching": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": url + 'Pendaftar/ambilPendaftar',
			"type": "POST"
		},

		"columnDefs": [{
				"targets": [0, 2, 3, -1],
				"orderable": false
			}

		]
	});
	// batas akhir untuk tabel verifikasi\

	// statistik
	function statistik() {
		var url = $('.url').val()
		$.ajax({
			url: url + 'Admin/statistik',
			method: 'post',
			dataType: 'json',
			success: function (respon) {
				$('.jmlPendaftar').append(respon.daftar)
				$('.jmlVerifikasi').append(respon.verifikasi)
				$('.jmlProses').append(respon.proses)
				$('.jmlCabut').append(respon.mundur)
			}

		})
	}
	// tabel zonasi
	$('#tabelZonasi').DataTable({
		"scrollCollapse": true,
		"paging": true,
		"searching": true,
		"columnDefs": [{
				"targets": [0, 1, 2, 3, 4, 5, 6, -1],
				"orderable": false
			}

		]

	});

	// tabel zonasi
	$('#tablePrestasi').DataTable();

})
$('.card-body').on('click', '.tombolHapus', function (e) {
	e.preventDefault();
	const hrefHapus = $(this).attr('href');
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Ingin Menghapus Data Peserta",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yakin!, Hapus Saja'
	}).then((result) => {
		if (result.value) {
			document.location.href = hrefHapus
		}
	})

})

// tabel kelulusan
$('#tabelLulus').DataTable({
	"scrollCollapse": true,
	"paging": true,
	"searching": true

});
// table persyaratan
$('.tablePeryaratan').DataTable({
	"scrollCollapse": true,
	"paging": true,
	"searching": true

});
// tobol resset
$('.tombol-reset').on('click', function (e) {
	e.preventDefault();
	let hrefNya = $(this).attr('href');
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Ingin Mereset Data Status menjadi  Verifikasi",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yakin!, Reset Saja'
	}).then((result) => {
		if (result.value) {
			document.location.href = hrefNya
		}
	})

})

// tobol kosongkan
$('.tombol-kosongkan').on('click', function (e) {
	e.preventDefault();
	let hrefNya = $(this).attr('href');
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Ingin Mengosongkan Database kami sarankan untuk meng backup dulu database ",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yakin!, Kosongkan Saja Saja'
	}).then((result) => {
		if (result.value) {
			document.location.href = hrefNya
		}
	})
})
// tombol-generatet
$('.tombol-generatet').on('click', function (e) {
	e.preventDefault();
	let hrefNya = $(this).attr('href');
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Ingin Mengenerate Data ini, kami sarankan cek kembali dan tutup form pendaftaran sebelum generate data",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yakin!, Generate Saja'
	}).then((result) => {
		if (result.value) {
			document.location.href = hrefNya
		}
	})
})


// view ulang data pendaftar setelah edit dengan ajx
function viewUlangPendaftar(koreg, id, url) {
	$('.loading').css('top', '0');
	$('.gambar-loading').css('opacity', '1');
	// var koreg = $(this).data('koreg');
	// var id = $(this).data('id');
	// var url = $('.url').val()
	$.ajax({
		url: url + 'Admin/getDataPendaftarById',
		method: 'POST',
		data: {
			id: id,
			koreg: koreg
		},
		dataType: 'json',
		success: function (respon) {
			// 
			if (respon.statusPendaftaran == 1) {
				$('#ver1').attr('checked', 'checked')
			} else if (respon.statusPendaftaran == 2) {
				$('#ver2').attr('checked', 'checked')

			} else {
				$('#ver3').attr('checked', 'checked')
			}
			$('#koreg').val(respon.koreg)
			$('#nama').val(respon.namaSiswa)
			$('#nisn').val(respon.nisnSiswa)
			$('#sekolah').val(respon.asalSekolah)
			$('#nilaiPrestasiPraktek').val(respon.nilaiPraktekPrestasi)
			$('#cabangPrestasi').val(respon.cabangPrestasi)
			$('#npsn').val(respon.npsnSekolah)
			$('#JalurPPDB').val(respon.id_jalur)
			$('#tingkat2').val(respon.idPrestasi)
			$('#nilaiJarak').val(respon.totalJarak)
			$('#nilaiPrestasi').val(respon.nilaiPrestasi)
			$('#totalNilai').val(respon.totalNilai)
			$('#latitude').val(respon.latitude)
			$('#longitude').val(respon.longitude)
			$('#rataRataNilai').val(respon.rataRataTotalNilai)
			$('#idDaftar').val(respon.id)
			$('#koregSen').val(respon.koreg)
			$('.inputNilaiPraktek').val(respon.nilaiPraktekPrestasi)
			$('#totalRataRata').val(respon.jumlahRataRata)
			$('#tempatLahir').val(respon.tempatLahirSiswa)
			$('#tanggalLahir').val(respon.tanggalLahirSiswa)
			$('#usiaSiswa').val(respon.usiaSiswa)
			// buat apdate nilai prkatek
			$('#idEdit').val(respon.id)
			$('#koregEdit').val(respon.koreg)
			// nilai pai
			$('#paiK4S1').val(respon.paiK4S1)
			$('#paiK4S2').val(respon.paiK4S2)
			$('#paiK5S1').val(respon.paiK5S1)
			$('#paiK5S2').val(respon.paiK5S2)
			$('#paiK6S1').val(respon.paiK6S1)
			$('#paiK6S2').val(respon.paiK6S2)
			// batas Nilai pai

			// nilai pkn
			$('#pknK4S1').val(respon.pknK4S1)
			$('#pknK4S2').val(respon.pknK4S2)
			$('#pknK5S1').val(respon.pknK5S1)
			$('#pknK5S2').val(respon.pknK5S2)
			$('#pknK6S1').val(respon.pknK6S1)
			$('#pknK6S2').val(respon.pknK6S2)
			// batas Nilai pkn

			// nilai indo
			$('#indoK4S1').val(respon.indoK4S1)
			$('#indoK4S2').val(respon.indoK4S2)
			$('#indoK5S1').val(respon.indoK5S1)
			$('#indoK5S2').val(respon.indoK5S2)
			$('#indoK6S1').val(respon.indoK6S1)
			$('#indoK6S2').val(respon.indoK6S2)
			// batas Nilai indo


			// nilai mtk
			$('#mtkK4S1').val(respon.mtkK4S1)
			$('#mtkK4S2').val(respon.mtkK4S2)
			$('#mtkK5S1').val(respon.mtkK5S1)
			$('#mtkK5S2').val(respon.mtkK5S2)
			$('#mtkK6S1').val(respon.mtkK6S1)
			$('#mtkK6S2').val(respon.mtkK6S2)
			// batas Nilai mtk

			// nilai ipa
			$('#ipaK4S1').val(respon.ipaK4S1)
			$('#ipaK4S2').val(respon.ipaK4S2)
			$('#ipaK5S1').val(respon.ipaK5S1)
			$('#ipaK5S2').val(respon.ipaK5S2)
			$('#ipaK6S1').val(respon.ipaK6S1)
			$('#ipaK6S2').val(respon.ipaK6S2)
			// batas Nilai ipa


			// nilai ips
			$('#ipsK4S1').val(respon.ipsK4S1)
			$('#ipsK4S2').val(respon.ipsK4S2)
			$('#ipsK5S1').val(respon.ipsK5S1)
			$('#ipsK5S2').val(respon.ipsK5S2)
			$('#ipsK6S1').val(respon.ipsK6S1)
			$('#ipsK6S2').val(respon.ipsK6S2)
			// batas Nilai ips

			// nilai sbdp
			$('#sbdpK4S1').val(respon.sbdpK4S1)
			$('#sbdpK4S2').val(respon.sbdpK4S2)
			$('#sbdpK5S1').val(respon.sbdpK5S1)
			$('#sbdpK5S2').val(respon.sbdpK5S2)
			$('#sbdpK6S1').val(respon.sbdpK6S1)
			$('#sbdpK6S2').val(respon.sbdpK6S2)
			// batas Nilai sbdp


			// nilai pjok
			$('#pjokK4S1').val(respon.pjokK4S1)
			$('#pjokK4S2').val(respon.pjokK4S2)
			$('#pjokK5S1').val(respon.pjokK5S1)
			$('#pjokK5S2').val(respon.pjokK5S2)
			$('#pjokK6S1').val(respon.pjokK6S1)
			$('#pjokK6S2').val(respon.pjokK6S2)
			// batas Nilai pjok

			// nilai sunda
			$('#sundaK4S1').val(respon.sundaK4S1)
			$('#sundaK4S2').val(respon.sundaK4S2)
			$('#sundaK5S1').val(respon.sundaK5S1)
			$('#sundaK5S2').val(respon.sundaK5S2)
			$('#sundaK6S1').val(respon.sundaK6S1)
			$('#sundaK6S2').val(respon.sundaK6S2)
			// batas Nilai sunda
			$('.modalPendaftar').modal({
				'show': true,
				'backdrop': false
			})
			if (respon.idPrestasi > 0) {
				$.ajax({
					url: url + 'Admin/getDataPrestasiByIdDaftar',
					method: 'POST',
					data: {
						id: respon.idPrestasi,
						koreg: koreg
					},
					dataType: 'json',
					success: function (respon2) {
						$('.jalurAkademikNonakademik').html(``);
						if (respon2 == null) {
							$('.jalurAkademikNonakademik').append(``);
						}
						$('.jalurAkademikNonakademik').append(`
					<p class="text-warning">Tabel ini akan muncul bagi pendaftar jalur Prestasi Loba Akademik dan Non Akademik</p>
							<table class="table table-sm">
								<tr>
									<td>Penyelengara</td>
									<td>:</td>
									<td>` + respon2.peyelengara + `</td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td>` + respon2.satuan + `</td>
								</tr>
								<tr>
									<td>Kejuaraan</td>
									<td>:</td>
									<td>` + respon2.kejuaraan + `</td>
								</tr>
								<tr>
								<td>Score</td>
								<td>:</td>
								<td>` + respon2.score + `</td>
							</tr>
							</table>
					<p class="text-danger">Jika ingin merubah nilai di atas silahkan seting pada select box dibawah ini</p>

					`)
					}
				})
			}
			$('.loading').css('top', '100%');
			$('.gambar-loading').css('opacity', '0');
		}
	})
	// loading end
}

// ngambil data kota dengan prov
$('.provinsi').on('change', function () {
	$('.Kota').html('');
	var url = $('.url').data('url');
	var id = $(this).val();
	$.ajax({
		url: url + 'Setting/GetdataKotaByid',
		method: 'post',
		dataType: 'json',
		data: {
			id: id
		},
		success: function (respon) {
			$('.Kota').append(`<option value="">Pilih Kota</option>`);
			$.each(respon, function (key, value) {
				$('.Kota').append(`<option value="` + value.id + `">` + value.name + `</option>`);
			});
		}
	})
})

// nyokot data kecamatan ku kota
$('.Kota').on('change', function () {
	$('.kecamatan').html('');
	var url = $('.url').data('url');
	var id = $(this).val();
	$.ajax({
		url: url + 'Setting/GetdatakecamatanByidKota',
		method: 'post',
		dataType: 'json',
		data: {
			id: id
		},
		success: function (respon) {
			$('.kecamatan').append(`<option value="">Pilih Kecamatan</option>`);
			$.each(respon, function (key, value) {
				$('.kecamatan').append(`<option value="` + value.id + `">` + value.name + `</option>`);
			});
		}
	})
})

// loading end
$('.loading').css('top', '100%');
$('.gambar-loading').css('opacity', '0');
