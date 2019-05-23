<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class GetAllInformation implements CriteriaInterface
{
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }
}