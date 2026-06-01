<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        function confirmModal(title, message, confirmButtonText, cancelButtonText, icon = 'question', onConfirm) {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 (Swal) is not loaded!');
                return;
            }
            Swal.fire({
                title: '<span class="font-inter uppercase font-black text-mm-navy">' + title + '</span>',
                html: '<p class="font-didact text-gray-500">' + message + '</p>',
                icon: icon,
                showCancelButton: true,
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText,
                buttonsStyling: false,
                customClass: {
                    popup: '!rounded-3xl !p-8',
                    confirmButton: 'bg-[#15395c] text-white px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-[#1c4974] transition-all mr-3',
                    cancelButton: 'bg-gray-300 text-gray-500 px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-gray-200 transition-all'
                }
            }).then((result) => {
                if (result.isConfirmed && typeof onConfirm === 'function') {
                    onConfirm();
                }
            });
        }


        // SweetAlert Delete Something
        function confirmDelete(type,message) {
            confirmModal('Confirm Delete', message, 'DELETE', 'CANCEL', 'warning', function() {
                showSuccessModal(type + ' deleted');
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


        
        function showBookingDetail(code, type, vehicle, time, notes, status, customerName = null, customerId = null) {
		let statusHtml = '';
		if(status === 'pending') statusHtml = '<span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-sm fpn font-black">Pending</span>';
		if(status === 'waiting') statusHtml = '<span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-black">In Queue</span>';
		if(status === 'processing') statusHtml = '<span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full text-sm font-black">Processing</span>';
		if(status === 'finished') statusHtml = '<span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm font-black">Finished</span>';
		if(status === 'cancelled') statusHtml = '<span class="px-3 py-1 bg-red-50 text-red-400 rounded-full text-sm font-black">Cancelled</span>';

		Swal.fire({
			title: `<span class="font-inter uppercase font-black text-mm-navy">${code}</span>`,
			html: `
				<div class="text-left space-y-4 pt-4">
					<div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
						${status ? `
						<div class="flex justify-between items-center">
							<span class="text-sm font-bold text-black font-didact  tracking-wider">Status</span>
							<div class="font-albert text-sm font-light">${statusHtml}</div>
						</div>
						` : ''}
						${customerName ? `
						<div class="flex justify-between items-center">
							<span class="text-sm font-bold text-black font-didact tracking-wider">Customer</span>
							<span class="font-light text-black font-albert text-sm text-right">${customerName} ${customerId ? `(${customerId})` : ''}</span>
						</div>
						` : ''}
						<div class="flex justify-between items-center">
							<span class="text-sm font-bold text-black font-didact tracking-wider">Vehicle</span>
							<span class="font-light text-black font-albert text-sm text-right">${vehicle}</span>
						</div>
						<div class="flex justify-between items-center">
							<span class="text-sm font-bold text-black font-didact tracking-wider">Type</span>
							<span class="font-light text-black font-albert text-sm text-right">${type}</span>
						</div>
						<div class="flex justify-between items-start gap-4">
							<span class="text-sm font-bold text-black font-didact tracking-wider shrink-0">Notes</span>
							<span class="font-light text-black font-albert text-sm text-right italic">${notes}</span>
						</div>
						<div class="flex justify-between items-center gap-4">
							<span class="text-sm font-bold text-black font-didact tracking-wider">Time</span>
							<span class="font-light text-black font-albert text-sm text-right">${time}</span>
						</div>
					</div>
				</div>
			`,
			showConfirmButton: false,
			showCloseButton: false,
			customClass: {
				popup: '!rounded-[32px] !p-8',
				title: '!text-2xl !p-0 !mb-2',
				htmlContainer: '!m-0 !p-0'
                    }
                });
            }
        



    </script>