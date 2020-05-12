<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Escala.
 *
 * @package namespace App\Models;
 */
class Escala extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rota_id',
        'fiscal_id',
        'mes',
    ];

    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->fiscal->where('nome', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }

}
