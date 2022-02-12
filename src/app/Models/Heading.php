<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
