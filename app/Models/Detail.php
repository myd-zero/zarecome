<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['id_detail', 'nmcafe', 'altcafe', 'file_menu', 'keterangan_menu'];
}
