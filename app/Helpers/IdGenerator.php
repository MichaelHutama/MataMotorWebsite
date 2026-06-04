<?php

namespace App\Helpers;

use Carbon\Carbon;

class IdGenerator
{
    /**
     * Generate: CUS-1, CUS-2, ...
     */
    public static function customer(): string
    {
        $last = \App\Models\Customer::selectRaw('CustomerID')
            ->get()
            ->map(fn($c) => (int) str_replace('CUS-', '', $c->CustomerID))
            ->max() ?? 0;
        return 'CUS-' . ($last + 1);
    }

    /**
     * Generate: MEC-1, MEC-2, ... (MEC-0 reserved for owner)
     */
    public static function mechanic(): string
    {
        $last = \App\Models\Mechanic::selectRaw('MechanicID')
            ->get()
            ->map(fn($m) => (int) str_replace('MEC-', '', $m->MechanicID))
            ->max() ?? 0;
        $next = max($last + 1, 1); // tidak boleh 0 (reserved owner)
        return 'MEC-' . $next;
    }

    /**
     * Generate: SVC-1, SVC-2, ...
     */
    public static function serviceCategory(): string
    {
        $last = \App\Models\ServiceCategory::get()
            ->map(fn($s) => (int) str_replace('SVC-', '', $s->ServiceCategoryID))
            ->max() ?? 0;
        return 'SVC-' . ($last + 1);
    }

    /**
     * Generate: SPC-1, SPC-2, ...
     */
    public static function sparePartCategory(): string
    {
        $last = \App\Models\SparePartCategory::get()
            ->map(fn($s) => (int) str_replace('SPC-', '', $s->SparePartCategoryID))
            ->max() ?? 0;
        return 'SPC-' . ($last + 1);
    }

    /**
     * Generate: CUS-1-VEC-1, CUS-1-VEC-2 (sequence per customer)
     */
    public static function vehicle(string $customerId): string
    {
        $prefix = $customerId . '-VEC-';
        $last = \App\Models\Vehicle::where('CustomerID', $customerId)
            ->get()
            ->map(fn($v) => (int) str_replace($prefix, '', $v->VehicleID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: SP-1, SP-2, ...
     */
    public static function sparePart(): string
    {
        $last = \App\Models\SparePart::get()
            ->map(fn($s) => (int) str_replace('SP-', '', $s->SparePartID))
            ->max() ?? 0;
        return 'SP-' . ($last + 1);
    }

    /**
     * Generate: T-20250604-1, T-20250604-2 (sequence per tanggal)
     */
    public static function transaction(): string
    {
        $today = Carbon::now()->format('Ymd');
        $prefix = 'T-' . $today . '-';
        $last = \App\Models\Transaction::where('TransactionID', 'LIKE', $prefix . '%')
            ->get()
            ->map(fn($t) => (int) str_replace($prefix, '', $t->TransactionID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: Q-20250604-1, Q-20250604-2 (sequence per tanggal booking)
     */
    public static function queue(string $bookingDate): string
    {
        // bookingDate format: Y-m-d
        $dateStr = Carbon::parse($bookingDate)->format('Ymd');
        $prefix = 'Q-' . $dateStr . '-';
        $last = \App\Models\Queue::where('QueueID', 'LIKE', $prefix . '%')
            ->get()
            ->map(fn($q) => (int) str_replace($prefix, '', $q->QueueID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: CUS-1-CART-1, CUS-1-CART-2 (sequence per customer)
     */
    public static function cart(string $customerId): string
    {
        $prefix = $customerId . '-CART-';
        $last = \App\Models\Cart::where('CustomerID', $customerId)
            ->get()
            ->map(fn($c) => (int) str_replace($prefix, '', $c->CartID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: T-20250604-1-PAY-1 (sequence per transaksi)
     */
    public static function payment(string $transactionId): string
    {
        $prefix = $transactionId . '-PAY-';
        $last = \App\Models\Payment::where('TransactionID', $transactionId)
            ->get()
            ->map(fn($p) => (int) str_replace($prefix, '', $p->PaymentID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: SPS-T-20250604-1-1 (sequence per transaksi)
     */
    public static function sparePartSales(string $transactionId): string
    {
        $prefix = 'SPS-' . $transactionId . '-';
        $last = \App\Models\SparePartSales::where('TransactionID', $transactionId)
            ->get()
            ->map(fn($s) => (int) str_replace($prefix, '', $s->SparePartSalesID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: SVP-T-20250604-1-1 (sequence per transaksi)
     */
    public static function servicePerformed(string $transactionId): string
    {
        $prefix = 'SVP-' . $transactionId . '-';
        $last = \App\Models\ServicePerformed::where('TransactionID', $transactionId)
            ->get()
            ->map(fn($s) => (int) str_replace($prefix, '', $s->ServiceID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }

    /**
     * Generate: SPR-SVP-T-20250604-1-1-1 (sequence per service performed)
     */
    public static function sparePartRequest(string $serviceId): string
    {
        $prefix = 'SPR-' . $serviceId . '-';
        $last = \App\Models\SparePartRequest::where('ServiceID', $serviceId)
            ->get()
            ->map(fn($r) => (int) str_replace($prefix, '', $r->SparePartRequestID))
            ->max() ?? 0;
        return $prefix . ($last + 1);
    }
}