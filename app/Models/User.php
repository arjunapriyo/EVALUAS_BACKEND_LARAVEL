<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = null;
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'id_buku', 'no_tlp', 'alamat', 'role'];

    // Relasi ke model Kelas
    public function buku()
    {
        return $this->belongsTo(buku::class, 'id');
    }
}

