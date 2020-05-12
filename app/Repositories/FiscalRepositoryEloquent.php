<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FiscalRepository;
use App\Models\Fiscal;
use App\Validators\FiscalValidator;

/**
 * Class FiscalRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FiscalRepositoryEloquent extends BaseRepository implements FiscalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fiscal::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
