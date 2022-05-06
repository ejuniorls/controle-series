<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Serie extends Model
{
    protected $table = 'series';
    protected $fillable = [
        'nome',
        'capa'
    ];

    public function getCapaUrlAttribute()
    {
        if ($this->capa) {
            return Storage::url($this->capa);
        }
        return Storage::url('serie/baixados.png');
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}
