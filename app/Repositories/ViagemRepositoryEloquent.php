<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ViagemRepository;
use App\Models\Viagem;
use App\Validators\ViagemValidator;

/**
 * Class ViagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ViagemRepositoryEloquent extends BaseRepository implements ViagemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Viagem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
