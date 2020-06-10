<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Historico.
 *
 * @package namespace App\Models;
 */
class Historico extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'diligencia_id',
        'tipo_historico_id',
        'fiscal_id',
        'numero',
    ];

    public function diligencia()
    {
        return $this->belongsTo(Diligencia::class);
    }

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function tipo_historico()
    {
        return $this->belongsTo(TipoHistorico::class);
    }

}
