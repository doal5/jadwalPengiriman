    $(document).ready(function() {
        $('a#logout').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Apakah Anda Yakin Akan Logout??",
                text: '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Akan Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./logout.php",
                        data: {
                            'a#logout': true,
                        },
                        success: function(response) {
                            location.href = 'login.php';
                        }
                    });
                }
            })
        })
    });