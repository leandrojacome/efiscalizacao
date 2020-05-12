<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrigemRepository;
use App\Models\Origem;
use App\Validators\OrigemValidator;

/**
 * Class OrigemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrigemRepositoryEloquent extends BaseRepository implements OrigemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Origem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
