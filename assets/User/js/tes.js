$('.mulai-event').on('click', function (e) {
	
	e.preventDefault();

	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Yakin Mengikuti Event Ini?',
	  text: "Dengan klik tombol Yakin, maka anda akan mengikuti event dan point anda akan berkurang.",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yakin',
	  cancelButtonText: 'Batal'
	}).then((result) => {
	  if (result.value) {
	    Swal.fire(
	      'Selamat!!',
	      'Sekarang anda mengikuti event ini',
	      'success'
	    ).then((result) => {
	    	document.location.href = href;
	    })
	  }
	})
});