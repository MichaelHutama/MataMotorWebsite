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


        // SweetAlert Delete Vehicle
        function confirmDelete(type,message) {
            Swal.fire({
                html: message,
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                didOpen: () => {
                    const popup = Swal.getPopup();
                    if (popup) {
                        popup.style.fontFamily = "'Century Gothic', sans-serif";
                    }
                },
                customClass: {
                    popup: '!rounded-[30px]',
                    htmlContainer: '!text-center',
                    confirmButton: '!bg-[#15395c] !text-white !rounded-[30px] !font-bold !text-sm !px-6 !py-2.5 !min-w-[110px] !shadow-none',
                    cancelButton: '!bg-gray-500 !text-white !rounded-[30px] !font-bold !text-sm !px-6 !py-2.5 !min-w-[110px] !shadow-none !ml-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    showSuccessModal(type + ' deleted');
                }
            });
        }



        /**
         MODAL SUCCESS MESSAGE
         */
        function showSuccessModal(message) {
            return Swal.fire({
                icon: 'success',
                iconColor: '#10b981',
                title: message,
                width: 380,
                buttonsStyling: false,
                background: '#ffffff',
                confirmButtonText: 'OK',
                customClass: {
                    popup: '!rounded-3xl !p-8 flex flex-col items-center shadow-2xl border border-gray-100',
                    icon: '!scale-125 !my-4',
                    title: '!text-2xl !font-bold !text-gray-800 !mt-2 !mb-6 !tracking-wide',
                    confirmButton: '!bg-[#15395c] hover:!bg-[#1c4974] !text-white !rounded-full !px-14 !py-3 !text-sm !font-bold !tracking-[0.1em] !shadow-md hover:!shadow-lg transition-all duration-300 !outline-none'
                }
            });
        }

        // Contoh pemanggilan
        // showSuccessModal('2 items added');



    </script>