<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Fiscal.
 *
 * @package namespace App\Models;
 */
class Fiscal extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "fiscais";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'telefone',
        'disponivel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escalas()
    {
        return $this->hasMany(Escala::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->user->where('name', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }

}
