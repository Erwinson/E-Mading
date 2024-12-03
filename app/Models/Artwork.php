<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Artwork extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'artworks';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'title', 
        'description', 
        'category', 
        'file_path', 
        'student_id', 
        'submitted_at', 
        'likes_count'
    ];

    /**
     * Relasi dengan model User (student yang mengirim karya)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
