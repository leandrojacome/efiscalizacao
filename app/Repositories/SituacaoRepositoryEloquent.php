<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SituacaoRepository;
use App\Models\Situacao;
use App\Validators\SituacaoValidator;

/**
 * Class SituacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SituacaoRepositoryEloquent extends BaseRepository implements SituacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Situacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
