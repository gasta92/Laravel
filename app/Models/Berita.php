<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar',
        'judul',
        'isi',
    ];

    public function P_Kategori(){
        return $this->belongsTo(Kategori::class,'idkategori','id');
    }
}
