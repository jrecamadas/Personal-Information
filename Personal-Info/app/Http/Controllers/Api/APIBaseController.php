<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use \Prettus\Validator\Exceptions\ValidatorException;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Http\Request;
use \Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Api\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class APIBaseController extends BaseController implements APIInterface
{
    use Helpers;

    /**
     * GET list of resource
     *
     * @param Dingo\Api\Http\Request
     * @return Resource Collection
     */
    
    public function index(Request $request)
    {
        if($this->repository->model() == "App\Models\PersonalInformation") {
            if($request->get('user_id') && ($request->get('include') && $request->get('include') == "photo")) {
                //Do nothing
            } 
            else {
                $modelObj = app($this->repository->model());
                //$this->authorize('view', $modelObj);
            }
            
        } else {
            $modelObj = app($this->repository->model());
            //$this->authorize('view', $modelObj);
        }

        $limit = $request->get('take') ? $request->get('take') : config('repository.pagination.limit', 15);

        if ($request->get('orderBy')) {
            if (is_array($request->get('orderBy'))) {
                foreach ($request->get('orderBy') as $sorting) {
                    $orderBy = $this->getOrderBy($sorting);

                    $this->setOrderBy($orderBy);
                }
            } else {
                $orderBy = $this->getOrderBy($request->get('orderBy'));

                $this->setOrderBy($orderBy);
            }
        }

        $result = $this->repository->paginate($limit);

        return $this->response
                    ->paginator($result, $this->transformer)
                    ->withHeader('Content-Range', $result->total());
    }

    /**
     * GET a resource specified by id
     *
     * @param int $id
     * @return Resource Item
     */
    public function show($id)
    {
        if (!is_null(request('user')) && 'me' === request('user')) {
            // does nothing
        } else {
            // otherwise, authorize request
            $modelObj = app($this->repository->model());
            //$this->authorize('view', $modelObj);
        }

        try {
            $result = $this->repository->find($id);
            return $this->response->item($result, $this->transformer);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Can\'t find the requested resource.'
            ], 404);
        }
    }

    /**
     * Handle POST request for the resource, saving new data
     *
     * @param Dingo\Api\Http\Request $request
     * @return Resource Item
     */
    public function store(Request $request)
    {
        $modelObj = app($this->repository->model());
        //$this->authorize('create', $modelObj);

        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $result = $this->repository->create($request->all());

            return $this->response->item($result, $this->transformer);
        } catch (ValidatorException $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    /**
     * DELETE a resource specified by id
     *
     * @param int $id
     * @return noContent
     */
    public function destroy($id)
    {
        $modelObj = app($this->repository->model());
        //$this->authorize('delete', $modelObj);

        try {
            $resource = $this->find($id);

            if ($resource->delete()) {
                return $this->response->noContent();
            } else {
                return $this->response->error('could_not_delete_book', 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Can\'t find the requested resource.'
            ]);
        }
    }

    /**
     * PUT|PATCH update a resource
     *
     * @param Dingo\Api\Http\Request $request
     * @param int $id
     * @return Resource Item
     */
    public function update(Request $request, $id)
    {
        $modelObj = app($this->repository->model());
        //$this->authorize('update', $modelObj);

        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $result = $this->repository->update($request->all(), $id);

            return $this->response->item($result, $this->transformer);
        } catch (ValidatorException $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    /**
     * Get sorting detail
     *
     * @param string $orderBy
     * @return array
     */
    protected function getOrderBy($orderBy)
    {
        $orderBy = explode('|', $orderBy);
        $orderBy[1] = isset($orderBy[1]) ? $orderBy[1] : 'asc';

        return $orderBy;
    }

    /**
     * Find a resource specified by id
     *
     * @param int $id
     * @return Resource
     */
    private function find($id)
    {
        return $this->repository->makeModel()->find($id);
    }

    /**
     * Set order by
     *
     * @param array $orderBy
     * @return void
     */
    private function setOrderBy($orderBy)
    {
        $this->repository->orderBy(
            $orderBy[0],
            $orderBy[1]
        );
    }
}
