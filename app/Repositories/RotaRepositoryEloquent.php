<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RotaRepository;
use App\Models\Rota;
use App\Validators\RotaValidator;

/**
 * Class RotaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RotaRepositoryEloquent extends BaseRepository implements RotaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rota::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
