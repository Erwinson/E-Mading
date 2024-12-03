<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'likes';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'artwork_id',
    ];

    /**
     * Relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Artwork.
     */
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
