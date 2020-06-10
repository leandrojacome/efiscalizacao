<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TermoRepresentacao.
 *
 * @package namespace App\Models;
 */
class TermoRepresentacao extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'termos_represetacao';

    protected $fillable = [
        'localizacao_id',
        'cidade_id',
        'rota_id',
        'fiscal_id',
        'nome',
        'data_lavratura',
        'data_entrega',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }
    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->where('id', $data['busca'])
                    ->orWhere('nome', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }
}
