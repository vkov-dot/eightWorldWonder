<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'heading_id'];

    public function getPhotoForIndex()
    {

    }
    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }
}
