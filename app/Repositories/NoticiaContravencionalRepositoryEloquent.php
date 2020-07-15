<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NoticiaContravencionalRepository;
use App\Models\NoticiaContravencional;
use App\Validators\NotociaContravencionalValidator;

/**
 * Class NoticiaContravencionalRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NoticiaContravencionalRepositoryEloquent extends BaseRepository implements NoticiaContravencionalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NoticiaContravencional::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
