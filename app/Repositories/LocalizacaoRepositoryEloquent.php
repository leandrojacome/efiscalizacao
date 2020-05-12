<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LocalizacaoRepository;
use App\Models\Localizacao;
use App\Validators\LocalizacaoValidator;

/**
 * Class LocalizacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LocalizacaoRepositoryEloquent extends BaseRepository implements LocalizacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Localizacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
