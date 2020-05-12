<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Origem.
 *
 * @package namespace App\Models;
 */
class Origem extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "origem";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
    ];

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] =  mb_strtoupper($value);
    }

    public function diligencias()
    {
        return $this->hasMany(Diligencia::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->where('nome', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }

}
