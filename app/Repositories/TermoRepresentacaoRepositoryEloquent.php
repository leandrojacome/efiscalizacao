<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TermoRepresentacaoRepository;
use App\Models\TermoRepresentacao;
use App\Validators\TermoRepresentacaoValidator;

/**
 * Class TermoRepresentacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TermoRepresentacaoRepositoryEloquent extends BaseRepository implements TermoRepresentacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TermoRepresentacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
