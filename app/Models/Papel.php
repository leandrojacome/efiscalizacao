<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

/**
 * Class Papel.
 *
 * @package namespace App\Models;
 */
class Papel extends Role
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'guard_name',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] =  mb_strtoupper($value);
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        if (static::where('name', $attributes['name'])
            ->where('guard_name', $attributes['guard_name'])
            ->where('slug', $attributes['slug'])
            ->first()) {
            throw RoleAlreadyExists::create($attributes['slug'], $attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->where('slug', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }

}
