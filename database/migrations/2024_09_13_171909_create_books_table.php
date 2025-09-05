<?php
// database/migrations/xxxx_xx_xx_create_books_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pengarang');
            $table->text('deskripsi');
            $table->foreignId('kategori_id')->constrained('categories')->onDelete('cascade');
            $table->integer('stok');
            $table->decimal('harga', 10, 3);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
