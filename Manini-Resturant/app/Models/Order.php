<?php
// ═══════════════════════════════════════════
// app/Models/Order.php
// ═══════════════════════════════════════════

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number','table_number','status',
        'subtotal','tax','total','notes','customer_name',
    ];

    public function items()    { return $this->hasMany(OrderItem::class); }
    public function payment()  { return $this->hasOne(Payment::class); }

    public function getFormattedTotalAttribute(): string
    {
        return '$' . number_format($this->total, 2);
    }

    protected static function booted()
    {
        static::creating(fn($o) => $o->order_number = 'ORD-' . strtoupper(uniqid()));
    }
}
