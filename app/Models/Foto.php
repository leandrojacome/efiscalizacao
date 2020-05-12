<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Foto.
 *
 * @package namespace App\Models;
 */
class Foto extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'diligencia_id',
		'path',
	];

    public function diligencia()
    {
        return $this->belongsTo(Diligencia::class);
    }
}
