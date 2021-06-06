<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{

    protected $fillable = ['numero'];
    public $timestamps = false;

    public function temposrada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
