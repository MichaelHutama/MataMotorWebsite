/**
 * Reusable utility functions for Mata Motor web
 */

window.MataMotor = {
    /**
     * Initialize a quantity control pair
     * @param {string} inputId - ID of the number input
     * @param {string} minusBtnId - ID of the minus button
     * @param {string} plusBtnId - ID of the plus button
     * @param {Function} onChange - Callback when value changes
     */
    initQuantityControl: function(inputId, minusBtnId, plusBtnId, onChange) {
        const input = document.getElementById(inputId);
        const minusBtn = document.getElementById(minusBtnId);
        const plusBtn = document.getElementById(plusBtnId);

        if (!input || !minusBtn || !plusBtn) return;

        const updateVal = (delta) => {
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || Infinity;
            let val = parseInt(input.value) || 1;
            
            val = Math.max(min, Math.min(max, val + delta));
            input.value = val;
            
            // Update minus button state
            minusBtn.disabled = (val <= min);
            minusBtn.style.opacity = (val <= min) ? '0.5' : '1';
            minusBtn.style.cursor = (val <= min) ? 'not-allowed' : 'pointer';

            // Update plus button state
            plusBtn.disabled = (val >= max);
            plusBtn.style.opacity = (val >= max) ? '0.5' : '1';
            plusBtn.style.cursor = (val >= max) ? 'not-allowed' : 'pointer';

            if (onChange) onChange(val);
        };

        minusBtn.addEventListener('click', () => updateVal(-1));
        plusBtn.addEventListener('click', () => updateVal(1));
        
        input.addEventListener('change', () => {
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || Infinity;
            let val = parseInt(input.value) || 1;
            
            val = Math.max(min, Math.min(max, val));
            input.value = val;
            
            minusBtn.disabled = (val <= min);
            minusBtn.style.opacity = (val <= min) ? '0.5' : '1';
            minusBtn.style.cursor = (val <= min) ? 'not-allowed' : 'pointer';

            plusBtn.disabled = (val >= max);
            plusBtn.style.opacity = (val >= max) ? '0.5' : '1';
            plusBtn.style.cursor = (val >= max) ? 'not-allowed' : 'pointer';

            if (onChange) onChange(val);
        });

        // Initialize state
        updateVal(0);
    },

    /**
     * Format number to IDR currency
     * @param {number} amount 
     * @returns {string}
     */
    formatIDR: function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount).replace('Rp', 'IDR');
    }
};
