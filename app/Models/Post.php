<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['title', 'content'];
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
