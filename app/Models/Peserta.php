<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['pilihan'];

    public function pilihan(){
        return $this->belongsTo(Pilihan::class);
    }
}
