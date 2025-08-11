<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','email','phone','address','sector_id','description'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
