<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class NoticiaContravencional.
 *
 * @package namespace App\Models;
 */
class NoticiaContravencional extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'noticia_contravencional';

    protected $fillable = [
        'localizacao_id',
        'cidade_id',
        'rota_id',
        'fiscal_id',
        'nome',
        'dp',
        'data_lavratura',
        'data_auto',
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
