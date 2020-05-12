<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PermissaoRepository;
use App\Models\Permissao;
use App\Validators\PermissaoValidator;

/**
 * Class PermissaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PermissaoRepositoryEloquent extends BaseRepository implements PermissaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permissao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
