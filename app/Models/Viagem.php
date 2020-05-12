<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Viagem.
 *
 * @package namespace App\Models;
 */
class Viagem extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "viagens";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim',
    ];

    public function cidades()
    {
        $this->belongsToMany(Cidade::class,'cidades_viagens');
    }

    public function fiscais()
    {
        $this->belongsToMany(Fiscal::class,'fiscais_viagens');
    }

}
