<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = ['items' => 'array'];

    protected $dates = ['date_start',  'date_end'];

    protected $guarded = []; //tudo que for enviado pelo post pode ser atualizado sem restrição

    protected $fillable = ['image', 'title', 'city', 'description', 'items', 'private', 'free', 'date_start', 'date_end'];

    //relacionamento  onde um usuário é dono do evento 
    public function user() {
        return $this->belongsTo('App\Models\User'); //esse evento pertence a um usuário
    }

    public function users() {
        return $this->belongsToMany('App\Models\User'); //esse evento pertence a muitos usuários
    }
}
