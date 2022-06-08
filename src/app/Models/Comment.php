<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'id', 'user_id', 'state_id', 'created_at', 'updated_at'];
    /**
     * @var mixed
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
