<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start extends Model
{
    protected function serializeDate()
    {
        return $this->format('Y/m/d');
    }
    use HasFactory;
}
