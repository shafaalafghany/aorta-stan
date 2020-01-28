var nav_login = document.querySelector('#nav-login');
var btn_close_login = document.querySelector('#close-login');
var btn_close_regist = document.querySelector('#close-regist');
var btn_close_lupa_pass = document.querySelector('#close-lupa-password');


var	btn_registrasi = document.querySelector('#registrasi');
var btn_kembali_login = document.querySelector('#kembali-login');
var btn_lupa_password = document.querySelector('#lupa-password');
var btn_lupa_ke_regist = document.querySelector('#lupa-keregist');


var btn_cek_email = document.querySelector('#btn-cek-email');
var btn_login = document.querySelector('#btn-login');
var btn_daftar = document.querySelector('#btn-daftar');
var btn_ganti_pass = document.querySelector('#btn-ganti-password');


nav_login.addEventListener('click', function() {
	document.querySelector('#modal-login').style.display = 'flex';
	document.querySelector('#modal-registrasi').style.display = 'none';
	document.querySelector('#modal-lupa-password').style.display = 'none';
	document.querySelector('#modal-ganti-password').style.display = 'none';
});

btn_close_login.addEventListener('click', function(){
	document.querySelector('#modal-login').style.display = 'none';
});

btn_close_regist.addEventListener('click', function(){
	document.querySelector('#modal-registrasi').style.display = 'none';
});

btn_close_lupa_pass.addEventListener('click', function(){
	document.querySelector('#modal-lupa-password').style.display = 'none';
});

btn_registrasi.addEventListener('click', function(){
	document.querySelector('#modal-registrasi').style.display = 'flex';
	document.querySelector('#modal-login').style.display = 'none';
});

btn_kembali_login.addEventListener('click', function(){
	document.querySelector('#modal-login').style.display = 'flex';
	document.querySelector('#modal-registrasi').style.display = 'none';
});

btn_lupa_password.addEventListener('click', function(){
	document.querySelector('#modal-lupa-password').style.display = 'flex';
	document.querySelector('#modal-login').style.display = 'none';
});

btn_lupa_ke_regist.addEventListener('click', function(){
	document.querySelector('#modal-registrasi').style.display = 'flex';
	document.querySelector('#modal-lupa-password').style.display = 'none';
});

btn_cek_email.addEventListener('click', function(e) {
	e.preventDefault();

	var email_lupa = document.querySelector('#email-lupa').value;

	if (email_lupa != "") {
		Swal.fire({
			title: "Sukses",
			text: "Silahkan Cek Email Anda",
			icon: "success",
			button: "Oke"
		}).then((result) => {
		  if (result.value) {
		    document.querySelector('#modal-ganti-password').style.display = 'flex';
		    document.querySelector('#modal-lupa-password').style.display = 'none';
		    email_lupa.value = "";
		  }
		});
	}
	else{
		Swal.fire({
			title: "Oops",
			text: "Email tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}
});

btn_login.addEventListener('click', function(e){
	e.preventDefault();

	var email_login = document.querySelector('#email-login');
	var pass_login = document.querySelector('#password-login');

	if (email_login.value != "" && pass_login.value != "") {
		Swal.fire({
			title: "Sukses",
			text: "Anda Berhasil Login",
			icon: "success",
			button: "Oke"
		}).then((result) => {
		  if (result.value) {
		    location.replace("index.html");
		    return 0;
		  }
		});
	}
	else{
		Swal.fire({
			title: "Gagal",
			text: "Email dan Password tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}
});

btn_daftar.addEventListener('click', function(e){
	e.preventDefault();

	var	email_regist = document.querySelector('#email-regist');
	var	nama_lengkap = document.querySelector('#nama-lengkap');
	var	password_regist = document.querySelector('#password-regist');
	var	ulangpass_regist = document.querySelector('#password-ulang-regist');

	if (nama_lengkap.value == "") {
		Swal.fire({
			title: "Oops",
			text: "Nama tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}

	else if (email_regist.value == ""){
		Swal.fire({
			title: "Oops",
			text: "Email tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}

	else if (password_regist.value == "") {
		Swal.fire({
			title: "Oops",
			text: "Password tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}

	else if (ulangpass_regist.value == "") {
		Swal.fire({
			title: "Oops",
			text: "Password Ulang tidak boleh kosong",
			icon: "error",
			button: "Oke"
		});
	}

	else if (password_regist.value != ulangpass_regist.value) {
		Swal.fire({
			title: "Oops",
			text: "Password dan Password Ulang tidak cocok",
			icon: "error",
			button: "Oke"
		});
	}

	else{
		Swal.fire({
			title: "Sukses",
			text: "Pendaftaran Berhasil",
			icon: "success",
			button: "Oke"
		}).then((result) => {
		  if (result.value) {
		    document.querySelector('#modal-registrasi').style.display = 'none';
		    document.querySelector('#modal-login').style.display = 'flex';
		    nama_lengkap.value="";
		    email_regist.value="";
		    password_regist.value="";
		    ulangpass_regist.value="";
		  }
		});
	}
});

btn_ganti_pass.addEventListener('click', function(e){
	e.preventDefault();

	var password_ganti = document.querySelector('#password-ganti');
	var password_ulang_ganti = document.querySelector('#password-ulang-ganti');

	if (password_ganti.value == "" || password_ulang_ganti.value == "") {
		Swal.fire({
			title: "Oops",
			text: "Password Baru dan Password Ulang tidak boleh kosong",
			icon: "warning",
			button: "Oke"
		});
	}

	else if (password_ganti.value != password_ulang_ganti.value) {
		Swal.fire({
			title: "Oops",
			text: "Password Baru dan Password Ulang tidak cocok",
			icon: "error",
			button: "Oke"
		});
	}

	else{
		Swal.fire({
			title: "Sukses",
			text: "Password Berhasil Diperbarui",
			icon: "success",
			button: "Oke"
		}).then((result) => {
		  if (result.value) {
		    document.querySelector('#modal-ganti-password').style.display = 'none';
		    document.querySelector('#modal-login').style.display = 'flex';
		    password_ganti.value="";
		    password_ulang_ganti.value="";
		  }
		});
	}
});