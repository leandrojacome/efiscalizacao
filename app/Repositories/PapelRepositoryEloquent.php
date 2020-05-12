<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PapelRepository;
use App\Models\Papel;
use App\Validators\PapelValidator;

/**
 * Class PapelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PapelRepositoryEloquent extends BaseRepository implements PapelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Papel::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
