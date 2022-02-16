<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'heading_id'];

    public function heading(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Heading::class);
    }
}
