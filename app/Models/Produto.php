<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public $table = 'produtos';
    public $primaryKey = 'id';

    public $fillable = [
        'id',
        'nome',
        'preco',
        'descricao',
        'url_imagem',
        'created_at',
        'updated_at'
    ];
}
