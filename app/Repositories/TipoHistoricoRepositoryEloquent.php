<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoHistoricoRepository;
use App\Models\TipoHistorico;
use App\Validators\TipoHistoricoValidator;

/**
 * Class TipoHistoricoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoHistoricoRepositoryEloquent extends BaseRepository implements TipoHistoricoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoHistorico::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
