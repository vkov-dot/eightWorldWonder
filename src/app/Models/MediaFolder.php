<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFolder extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
