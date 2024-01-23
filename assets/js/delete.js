   $(document).ready(function() {
        $('.hapus-btn').click(function(e) {
            e.preventDefault();
            var no_jadwal = $(this).val();
            Swal.fire({
                title: 'Apakah Anda Yakin Menghapus Kenangan Indah Ini?',
                text: "YAKIN?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "POST",
                        url: "hapusjadwal.php",
                        data: {
                            'no_jadwal': no_jadwal,
                            'hapus-btn': true, 
                        },
                        success: function(response) {
                            
                        }
                    });
                  Swal.fire(
                    'Kenangan Sudah Dihapus!',
                    'Semoga Akbar Bisa Bahagia DiSini',
                    'success'
                  )
                 $('#tr_'+no_jadwal).hide(2000);
                }
              })
            // swal({
            //         title: "Are you sure?",
            //         text: "Once deleted, you will not be able to recover this imaginary file!",
            //         icon: "warning",
            //         buttons: true,
            //         dangerMode: true,
            //     })
            //     .then((willDelete) => {
            //         if (willDelete) {
           
                            
            //             });
            //         }
            //     });
        });
    });
