<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MovimentacaoRepository;
use App\Models\Movimentacao;
use App\Validators\MovimentacaoValidator;

/**
 * Class MovimentacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MovimentacaoRepositoryEloquent extends BaseRepository implements MovimentacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movimentacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
