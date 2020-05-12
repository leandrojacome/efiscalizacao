<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FotoRepository;
use App\Models\Foto;
use App\Validators\FotoValidator;

/**
 * Class FotoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FotoRepositoryEloquent extends BaseRepository implements FotoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Foto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
