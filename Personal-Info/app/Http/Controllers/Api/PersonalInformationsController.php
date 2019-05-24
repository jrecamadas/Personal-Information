<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\APIBaseController as BaseController;
use App\PersonalInformation;
use Dingo\Api\Http\Request;
use App\Repositories\PersonalInformationRepository;
use App\Validators\PersonalInformationValidator;
use App\Transformers\PersonalInformationTransformer;
use App\Criterias\GetAllInformation;
use App\Criterias\SearchByName;

class PersonalInformationsController extends BaseController
{
    public function __construct(PersonalInformationRepository $repository, PersonalInformationValidator $validator, 
    PersonalInformationTransformer $transformer)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->transformer = $transformer;
    }
    public function retrieveData(Request $request, PersonalInformationRepository $repository)
    {
        try 
        {
            return parent::index($request);
        } catch (Exception $e) 
        {
            return $this->response->json([
                'status_code' => 404,
                'message' => 'Can\'t find the requested resource.'
            ], 404);
        }
    }
    public function getDataByName(Request $request)
    {
        try 
        {
            //return $request->get('name');
            $this->repository->pushCriteria(new SearchByName($request->get('name')));
            return parent::index($request);
        } 
        catch (Exception $e) 
        {
            return response()->json([
                'status_code' => 404,
                'message' => 'Can\'t find the requested resource.'
            ], 404);
        }
    }
    public function restore(Request $request, $id)
    {
        try
        {
            //$this->repository->pushCriteria(new SearchByName($request->get($id)));
            $this->repository->find($id)->restore();
            return parent::update($request, $id);

            // $this->repository->model()::where('name', $request->get('name'))->update([
            //     'address' => $request->get('address'),
            //     'phone_number' => $request->get('phone_number'),
            //     'email' => $request->get('email')
            //     ]);
            //     return parent::index($request);

            // $this->repository->where('name', $request->get('name'))->update([
            //     'address' => $request->get('address'),
            //     'phone_number' => $request->get('phone_number'),
            //     'email' => $request->get('email')
            //     ]);
            //return parent::index($request);
        }
        catch (Exception $e) 
        {
            return response()->json([
                'status_code' => 404,
                'message' => 'Can\'t find the requested resource.'
            ], 404);
        }
    }
}