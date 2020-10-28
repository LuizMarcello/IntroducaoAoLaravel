<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    /* Para o laravel saber quais são os campos que podem
       ser atribuidos e criados os registros em massa */
       protected $fillable = 
       [
           'titulo','descricao','valor','imagem','publicacao'
       ];
    
}
