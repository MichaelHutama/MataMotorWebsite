<script>
	function editProfile() {
		const modalHtml = `
			<div class="w-[561px] max-w-full min-h-[826px] bg-white px-10 pt-8 pb-7" style="font-family: 'Didact Gothic', sans-serif;">
				<div class="text-center mb-7" style="font-family: 'Century Gothic', sans-serif;">
					<h2 class="text-[40px] leading-tight font-bold text-black">Edit Profile</h2>
				</div>

				<div class="space-y-5 text-[15px] text-black text-left">
					<div>
						<label for="edit-profile-picture" class="block mb-2 font-normal text-left">Profile Picture</label>
						<input id="edit-profile-picture" type="file" accept="image/*" class="block w-full rounded-md border border-gray-300 bg-white p-2 text-sm text-gray-500 outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] file:mr-4 file:rounded-full file:border-0 file:bg-[#15395c]/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[#15395c] hover:file:bg-[#15395c]/20">
					</div>

					<div>
						<label for="edit-fullname" class="block mb-2 font-normal text-left">Full Name</label>
						<input id="edit-fullname" type="text" value="Suryanto" placeholder="Enter your full name" class="h-[42px] w-full rounded-md border border-gray-300 px-4 text-[15px] text-black outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] placeholder:text-gray-400">
					</div>

					<div>
						<label for="edit-email" class="block mb-2 font-normal text-left">Email</label>
						<input id="edit-email" type="email" value="suryanto@gmail.com" placeholder="Enter your email" class="h-[42px] w-full rounded-md border border-gray-300 px-4 text-[15px] text-black outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] placeholder:text-gray-400">
					</div>

					<div>
						<label for="edit-password" class="block mb-2 font-normal text-left">Password</label>
						<div class="relative">
							<input id="edit-password" type="password" placeholder="Enter your password" class="h-[42px] w-full rounded-md border border-gray-300 px-4 pr-20 text-[15px] text-black outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] placeholder:text-gray-400">
							<button type="button" data-edit-password-toggle aria-label="Toggle password visibility" class="absolute inset-y-0 right-3 my-auto inline-flex h-8 w-8 items-center justify-center text-[#15395c] hover:text-[#1c4974]">
								<svg data-icon-closed xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0 1 12 19c-5 0-9.27-3.11-11-7.5A11.96 11.96 0 0 1 5.06 5.06M9.88 4.24A9.94 9.94 0 0 1 12 4c5 0 9.27 3.11 11 7.5a11.9 11.9 0 0 1-4.18 5.14M3 3l18 18" />
								</svg>
								<svg data-icon-open xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
								</svg>
							</button>
						</div>
					</div>

					<div>
						<label for="edit-phone" class="block mb-2 font-normal text-left">Phone Number</label>
						<input id="edit-phone" type="tel" value="+62 867 8443 4143" placeholder="Enter your phone number" class="h-[42px] w-full rounded-md border border-gray-300 px-4 text-[15px] text-black outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] placeholder:text-gray-400">
					</div>

					<div>
						<label for="edit-address" class="block mb-2 font-normal text-left">Address</label>
						<textarea id="edit-address" rows="3" placeholder="Enter your address" class="w-full resize-none rounded-md border border-gray-300 px-4 py-2 text-[15px] text-black outline-none focus:border-[#15395c] focus:ring-1 focus:ring-[#15395c] placeholder:text-gray-400">Jalan Kemenangan No 17, Jakarta Barat</textarea>
					</div>
				</div>

				<div class="mt-8 flex items-center justify-center gap-8" style="font-family: 'Century Gothic', sans-serif;">
					<button type="button" data-edit-profile-cancel class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
					<button type="button" data-edit-profile-submit class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">Save</button>
				</div>
			</div>
		`;

		Swal.fire({
			html: modalHtml,
			showConfirmButton: false,
			showCancelButton: false,
			width: 561,
			padding: 0,
			background: '#ffffff',
			heightAuto: false,
			allowOutsideClick: false,
			customClass: {
				popup: '!rounded-[30px] !p-0 !overflow-hidden',
				htmlContainer: '!m-0 !p-0'
			},
			didOpen: () => {
				const popup = Swal.getPopup();
				if (!popup) {
					return;
				}

				popup.style.fontFamily = "'Didact Gothic', sans-serif";

				const cancelButton = popup.querySelector('[data-edit-profile-cancel]');
				const submitButton = popup.querySelector('[data-edit-profile-submit]');
				const passwordToggle = popup.querySelector('[data-edit-password-toggle]');
				const passwordInput = popup.querySelector('#edit-password');

				if (cancelButton) {
					cancelButton.addEventListener('click', () => Swal.close());
				}

				if (passwordToggle && passwordInput) {
					passwordToggle.addEventListener('click', () => {
						const isHidden = passwordInput.type === 'password';
						passwordInput.type = isHidden ? 'text' : 'password';
						const closedIcon = passwordToggle.querySelector('[data-icon-closed]');
						const openIcon = passwordToggle.querySelector('[data-icon-open]');

						if (closedIcon && openIcon) {
							closedIcon.classList.toggle('hidden', !isHidden);
							openIcon.classList.toggle('hidden', isHidden);
						}
					});
				}

				if (submitButton) {
					submitButton.addEventListener('click', () => {
						Swal.close();
						if (window.showSuccessModal) {
							showSuccessModal('Account edited');
						}
					});
				}
			}
		});
	}

	function openVehicleModal(mode = 'add', vehicleId = null) {
		const isEdit = mode === 'edit';
		const vehicles = window.customerVehicles || [];
		const vehicle = isEdit
			? (vehicles.find((item) => String(item.id) === String(vehicleId)) || {})
			: {};

		const title = isEdit ? 'Edit Vehicle' : 'Add Vehicle';
		const submitLabel = isEdit ? 'Save' : 'Add';
		const categoryOptions = [
			{ value: 'car', label: 'Car' },
			{ value: 'motorcycle', label: 'Motorcycle' },
			{ value: 'truck', label: 'Truck' },
		];

		const getCategoryLabel = (value) => {
			const matchedOption = categoryOptions.find((option) => option.value === value);
			return matchedOption ? matchedOption.label : 'Car, Motorcycle, etc?';
		};

		const selectedCategory = getCategoryLabel(vehicle.type);

		const modalHtml = `
			<div class="w-[410px] max-w-full min-h-[626px] bg-white px-6 pt-7 pb-6" style="font-family: 'Didact Gothic', sans-serif;">
				<div class="text-center mb-7" style="font-family: 'Century Gothic', sans-serif;">
					<h2 class="text-[34px] leading-none font-bold text-black">${title}</h2>
				</div>

				<div class="space-y-5 text-[15px] text-black text-left">
					<div>
						<label class="block mb-2 font-normal text-left">Category</label>
						<div class="relative group">
							<input id="vehicle-category" type="hidden" value="${vehicle.type ?? ''}">
							<button type="button" data-vehicle-category-button class="flex h-[42px] w-full items-center justify-between rounded-[10px] border border-gray-500 bg-white px-4 text-left text-[15px] text-gray-500 outline-none transition-colors hover:border-[#15395c]">
								<span data-vehicle-category-label>${selectedCategory}</span>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
								</svg>
							</button>
							<div class="absolute left-0 top-full z-20 mt-2 hidden w-full overflow-hidden rounded-[14px] border border-gray-200 bg-white shadow-[0_12px_30px_rgba(0,0,0,0.12)] group-hover:block">
								${categoryOptions.map((option) => `
									<button type="button" data-vehicle-category-option="${option.value}" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">
										${option.label}
									</button>
								`).join('')}
							</div>
						</div>
					</div>

					<div>
						<label class="block mb-2 font-normal text-left">Brand + Type</label>
						<input id="vehicle-name" type="text" value="${vehicle.name ?? ''}" placeholder="Example: Honda Vario 150" class="h-[42px] w-full rounded-[10px] border border-gray-500 px-4 text-[15px] text-black outline-none focus:border-[#15395c] placeholder:text-gray-400">
					</div>

					<div>
						<label class="block mb-2 font-normal text-left">Plate Number</label>
						<input id="vehicle-plate" type="text" value="${vehicle.plate ?? ''}" placeholder="Example: B 123 AB" class="h-[42px] w-full rounded-[10px] border border-gray-500 px-4 text-[15px] text-black outline-none focus:border-[#15395c] placeholder:text-gray-400">
					</div>

					<div>
						<label class="block mb-2 font-normal text-left">Production Year (Optional)</label>
						<input id="vehicle-year" type="text" value="${vehicle.year ?? ''}" placeholder="Example: 2026" class="h-[42px] w-full rounded-[10px] border border-gray-500 px-4 text-[15px] text-black outline-none focus:border-[#15395c] placeholder:text-gray-400">
					</div>
				</div>

				<div class="mt-8 flex items-center justify-center gap-8" style="font-family: 'Century Gothic', sans-serif;">
					<button type="button" data-vehicle-cancel class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
					<button type="button" data-vehicle-submit class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">${submitLabel}</button>
				</div>
			</div>
		`;

		Swal.fire({
			html: modalHtml,
			showConfirmButton: false,
			showCancelButton: false,
			width: 410,
			padding: 0,
			background: '#ffffff',
			heightAuto: false,
			allowOutsideClick: false,
			customClass: {
				popup: '!rounded-[30px] !p-0 !overflow-hidden',
				htmlContainer: '!m-0 !p-0',
			},
			didOpen: () => {
				const popup = Swal.getPopup();
				if (!popup) {
					return;
				}

				popup.style.fontFamily = "'Didact Gothic', sans-serif";

				const cancelButton = popup.querySelector('[data-vehicle-cancel]');
				const submitButton = popup.querySelector('[data-vehicle-submit]');
				const categoryButton = popup.querySelector('[data-vehicle-category-button]');
				const categoryLabel = popup.querySelector('[data-vehicle-category-label]');
				const categoryHiddenInput = popup.querySelector('#vehicle-category');
				const categoryOptionButtons = popup.querySelectorAll('[data-vehicle-category-option]');

				if (cancelButton) {
					cancelButton.addEventListener('click', () => Swal.close());
				}

				if (categoryButton) {
					categoryButton.addEventListener('click', () => {
						categoryButton.blur();
					});
				}

				categoryOptionButtons.forEach((optionButton) => {
					optionButton.addEventListener('click', () => {
						const selectedValue = optionButton.getAttribute('data-vehicle-category-option') || '';
						const selectedOption = categoryOptions.find((option) => option.value === selectedValue);

						if (categoryHiddenInput) {
							categoryHiddenInput.value = selectedValue;
						}

						if (categoryLabel) {
							categoryLabel.textContent = selectedOption ? selectedOption.label : selectedValue;
						}
					});
				});

				if (submitButton) {
					submitButton.addEventListener('click', () => {
						const category = popup.querySelector('#vehicle-category')?.value || '';
						const name = popup.querySelector('#vehicle-name')?.value || '';
						const plate = popup.querySelector('#vehicle-plate')?.value || '';
						const year = popup.querySelector('#vehicle-year')?.value || '';

						if (window.showSuccessModal) {
							Swal.close();
							showSuccessModal(isEdit ? 'Vehicle updated' : 'Vehicle added');
						}

						window.lastVehicleForm = {
							mode,
							category,
							name,
							plate,
							year,
							vehicleId,
						};
					});
				}
			}
		});
	}

	function addVehicle() {
		openVehicleModal('add');
	}

	function editVehicle(vehicleId) {
		openVehicleModal('edit', vehicleId);
	}
</script>
