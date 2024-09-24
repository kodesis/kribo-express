const flashdata = $(".flash-data").data("flashdata");
if (flashdata) {
	Swal.fire({
		title: "Success!! ",
		text: flashdata,
		// type: "success",
		icon: "success",
	});
}

const flashdata_error = $(".flash-data-error").data("flashdata");
if (flashdata_error) {
	Swal.fire({
		title: "Error!! ",
		text: flashdata_error,
		// type: "error",
		icon: "error",
	});
}

// jquery tolong carikan btn-delete yang ketika diklik jalankan fungsi berikut ini
$(document).ready(function () {
	$(".btn-delete").on("click", function (e) {
		e.preventDefault();
		const href = $(this).attr("href");

		console.log(href);
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = href;
			}
		});
	});

	// jquery tolong carikan btn-process yang ketika diklik jalankan fungsi berikut ini
	$(".btn-process").on("click", function (e) {
		e.preventDefault();
		const href = $(this).attr("href");

		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, process it!",
		}).then((result) => {
			if (result.isConfirmed) {

				Swal.fire({
					title: "Loading...",
					timerProgressBar: true,
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					},
				});

				document.location.href = href;
			}
		});
	});

	// sweetalert logout
	$(".btn-logout").on("click", function (e) {
		e.preventDefault();
		const href = $(this).attr("href");

		Swal.fire({
			title: "Are you sure?",
			// text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, sign me out!",
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = href;
			}
		});
	});

	$(".btn-confirm").on("click", function (e) {
		e.preventDefault();
		const form = $(this).parents("form");

		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, confirm!",
		}).then((result) => {
			if (result.isConfirmed) form.submit();
		});
	});

	$(document).on("click", ".btn-submit", function (e) {
		e.preventDefault();
		const form = $(this).parents("form");

		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, confirm!",
		}).then((result) => {
			if (result.isConfirmed) {

				form.on("submit", function () {
					Swal.fire({
						title: "Loading...",
						timerProgressBar: true,
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						},
					});
				});

				form.submit();
			}
		});
	});

	$(".btn-submit-detail").on("click", function (e) {
		e.preventDefault(); // Mencegah form agar tidak di-submit secara otomatis

		const form = $(this).parents("form");
		var previousRow = $('.baris').last();
		var isEmpty = false;

		// // Cek apakah ada input kosong di baris terakhir
		previousRow.find('input[type="text"]').each(function () {
			if ($(this).val().trim() === '') {
				isEmpty = true;
				return false;
			}
		});

		// Jika ada input kosong, tampilkan SweetAlert untuk memperingatkan pengguna
		if (isEmpty) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: 'Harap isi minimal 1 baris detail!'
			});
			return;
		} else {
			// Tampilkan SweetAlert untuk meminta konfirmasi dari pengguna
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, confirm!"
			}).then((result) => {
				// Jika pengguna mengonfirmasi, submit form secara manual
				if (result.isConfirmed) {
					form.submit(); // Submit form secara manual setelah konfirmasi
				}
			});
		}
	});
});

function reloadTable() {
	$(tableUser).DataTable().ajax.reload();
}

function swal_success(message) {
	Swal.fire({
		title: "Success!! ",
		text: message,
		icon: "success",
	});
}

function swal_error(message) {
	Swal.fire({
		title: "Failed ",
		text: message,
		icon: "error",
	});
}


function startTime() {
	const today = new Date();
	let day = today.getDay();
	let date = today.getDate();
	let month = today.getMonth();
	let year = today.getFullYear();
	let h = today.getHours();
	let m = today.getMinutes();
	let s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);

	let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
	let months = [
		"Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember",
	];

	const dayName = days[day];
	const monthName = months[month];
	document.getElementById("timer").innerHTML =
		dayName +
		", " +
		date +
		" " +
		monthName +
		" " +
		year +
		" " +
		h +
		":" +
		m +
		":" +
		s +
		" WIB";
	setTimeout(startTime, 1000);
}

function startTimeEnglish() {
	const today = new Date();
	let day = today.getDay();
	let date = today.getDate();
	let month = today.getMonth();
	let year = today.getFullYear();
	let h = today.getHours();
	let m = today.getMinutes();
	let s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);

	let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	let months = [
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December",
	];


	const dayName = days[day];
	const monthName = months[month];
	document.getElementById("timer").innerHTML =
		dayName +
		", " +
		date +
		" " +
		monthName +
		" " +
		year +
		" " +
		h +
		":" +
		m +
		":" +
		s +
		" WIB";
	setTimeout(startTimeEnglish, 1000);
}

function checkTime(i) {
	if (i < 10) {
		i = "0" + i;
	} // add zero in front of numbers < 10
	return i;
}

const d = new Date();
let year = d.getFullYear();
document.getElementById("tahun").innerHTML = year;
