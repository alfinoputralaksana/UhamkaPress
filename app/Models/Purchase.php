<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'book_name',
        'quantity',
        'total_price',
        'full_name',
        'phone_number',
        'address',
        'bank_name',
        'payment_proof',
        'status',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_name', 'judul');
    }
}
