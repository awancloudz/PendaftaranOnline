<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Peserta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['pilihan'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['kodepeserta'] ?? false, function($query, $kodepeserta){
            return $query->where('kodepeserta', $kodepeserta);
        });
        $query->when($filters['statusbayar'] ?? false, function($query, $statusbayar){
            if($statusbayar == "lunas"){
                $status = 1;
            }
            else if($statusbayar == "belum"){
                $status = 0;
            }
            return $query->where('statusbayar', $status);
        });
    }

    public function pilihan(){
        return $this->belongsTo(Pilihan::class);
    }
}
