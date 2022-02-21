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

    protected $fillable = ['title', 'logo', 'body'];


    public function states()
    {
        return $this->belongsTo(Heading::class);
    }

}
