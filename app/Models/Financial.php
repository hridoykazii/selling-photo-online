<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function cashouts()
    {
        return $this->hasMany(CashOut::class);
    }
}
