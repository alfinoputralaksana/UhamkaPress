<?php

// app/Models/Book.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'pengarang', 'deskripsi', 'kategori_id', 'stok', 'harga', 'image'
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    // Metode untuk mengurangi stok
    public function reduceStock($quantity)
    {
        // Pastikan stok cukup sebelum mengurangi
        if ($this->stok >= $quantity) {
            $this->stok -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }
}
