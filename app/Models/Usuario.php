<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $table = 'usuarios';
    public $primaryKey= 'correo';

    public $timestamps = false;


    protected $fillable = [
        'correo','nip','tipo','nip_especial'
    ];

    

}
