<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'comments';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id', 
        'artwork_id', 
        'comment',
    ];

    /**
     * Relasi dengan model User (user yang memberikan komentar).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Artwork (karya yang dikomentari).
     */
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
