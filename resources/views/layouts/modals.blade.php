<!--MODAL BOOKING DETAILS-->
<script>
        function modalBookingDetails() {
            Swal.fire({
                title: '<strong>Detail Antrean Anda</strong>',
                icon: 'info',
                html: `
                    <div class="text-left text-sm space-y-2 p-2">
                        <p><strong>Kode Booking:</strong> CUCI-22</p>
                        <p><strong>Jenis Layanan:</strong> Cuci Sepeda Motor</p>
                        <p><strong>Status:</strong> Menunggu</p>
                        <p><strong>Sisa Antrean:</strong> 2 Kendaraan Lagi</p>
                        <p class="text-xs text-gray-500 mt-4">*Harap stand-by di area ruang tunggu Mata Motor.</p>
                    </div>
                `,
                showCloseButton: true,
                confirmButtonText: 'Dimengerti',
                confirmButtonColor: '#004bb6',
            });
        }
</script>

    <script>
        // SweetAlert Delete Vehicle
        function confirmDelete(vehicleName) {
            Swal.fire({
                title: 'Hapus Kendaraan?',
                text: "Anda akan menghapus " + vehicleName + " dari daftar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Kendaraan berhasil dihapus.', 'success');
                }
            });
        }

        // SweetAlert Logout
        function confirmLogout() {
            Swal.fire({
                title: 'Log Out?',
                text: "Apakah anda yakin ingin keluar dari akun?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0a4f96',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Tetap Disini'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Logic logout bisa ditaruh disini (redirect atau form submit)
                    Swal.fire('Logged Out', 'Berhasil keluar akun.', 'success');
                }
            });
        }
    </script>