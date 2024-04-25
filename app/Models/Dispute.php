<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
