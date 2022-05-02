<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'heading_id', 'media_folder_id'];

    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }
}
