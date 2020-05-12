<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DiligenciaRepository;
use App\Models\Diligencia;
use App\Validators\DiligenciaValidator;

/**
 * Class DiligenciaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DiligenciaRepositoryEloquent extends BaseRepository implements DiligenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Diligencia::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
