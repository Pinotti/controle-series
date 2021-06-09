<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Serie extends Model
{

    public $timestamps = false;
    protected $fillable = ['nome', 'capa'];

    public function getCapaUrlAttribute()
    {
        return ($this->capa) ? Storage::url($this->capa) : Storage::url('serie/sem-imagem.gif');
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}