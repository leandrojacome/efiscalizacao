<?php

namespace App\Models;

use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

/**
 * Class Permissao.
 *
 * @package namespace App\Models;
 */
class Permissao extends Permission
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

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $permission = static::getPermissions(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])->first();

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['slug'], $attributes['name'], $attributes['guard_name']);
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
