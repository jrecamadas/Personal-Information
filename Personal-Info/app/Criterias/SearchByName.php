<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class SearchByName implements CriteriaInterface
{
    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where(function ($query) {
            $query->where('name', '=',  $this->term);
        });
    }
}