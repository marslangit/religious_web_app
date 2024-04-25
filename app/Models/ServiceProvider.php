<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
