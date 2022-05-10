<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'heading_id', 'archived', 'category_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
