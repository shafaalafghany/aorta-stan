$('.mulai-event').on('click', function (e) {
	
	e.preventDefault();

	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Yakin Mengikuti Event Ini?',
	  text: "Dengan menekan tombol Yakin, maka point anda akan berkurang sesuai harga event.",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yakin',
	  cancelButtonText: 'Batal'
	}).then((result) => {
	  if (result.value) {
	    document.location.href = href;
	  }
	})
});