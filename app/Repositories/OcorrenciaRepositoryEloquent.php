<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OcorrenciaRepository;
use App\Models\Ocorrencia;
use App\Validators\OcorrenciaValidator;

/**
 * Class OcorrenciaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OcorrenciaRepositoryEloquent extends BaseRepository implements OcorrenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ocorrencia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
