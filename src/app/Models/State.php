<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'body', 'heading_id', 'author', 'archived'];

    public function headings()
    {
        return $this->belongsTo(Heading::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
