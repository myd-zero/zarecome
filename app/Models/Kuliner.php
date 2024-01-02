<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail;

class Kuliner extends Model
{
    use HasFactory;

    protected $fillable = ['nmcafe', 'altcafe', 'file', 'keterangan', 'maps'];
    
    public function menus()
    {
        return $this->hasMany(Detail::class, 'id_detail', 'id');
    }
}
