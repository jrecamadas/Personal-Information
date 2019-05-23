<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\APIBaseController as BaseController;
use App\PersonalInformation;
use Dingo\Api\Http\Request;
use App\Repositories\PersonalInformationRepository;
use App\Validators\PersonalInformationValidator;
use App\Transformers\PersonalInformationTransformer;
use App\Criterias\GetAllInformation;

class PersonalInformationsController extends BaseController
{
    public function __construct(PersonalInformationRepository $repository, PersonalInformationValidator $validator, 
    PersonalInformationTransformer $transformer)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->transformer = $transformer;
    }
    public function index(Request $request)
    {
        return parent::index($request); 
    }
    public function retrieveData()
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
    public function create()
    {
        return view('personalinformations.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:100'],
            'birthday' => ['required', 'min:5', 'max:13'],
            'phone_number' => ['required', 'min:1', 'max:13'],
            'email' => ['required', 'min:1', 'max:25'],
        ]);
        PersonalInformation::create(request(['name', 'address', 'birthday', 'phone_number', 'email']));
        return redirect('/personalinformations');
    }
    public function show($personalinformation)
    {
        return view('personalinformations.display', compact('personalinformation'));
    }
    public function edit(PersonalInformation $personalinformation)
    {
        return view('personalinformations.update', compact('personalinformation'));
    }
    public function update(Request $request,$personalinformation)
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:100'],
            'birthday' => ['required', 'min:5', 'max:13'],
            'phone_number' => ['required', 'min:1', 'max:13'],
            'email' => ['required', 'min:1', 'max:25'],
        ]);
        $personalinformation->update(request(['name', 'address', 'birthday', 'phone_number', 'email']));
        return redirect('/personalinformations');
    }
    public function destroy($personalinformation)
    {
        $personalinformation->delete();
        return redirect('/personalinformations');
    }
}

//this is the original
/*
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalInformation;

class PersonalInformationsController extends Controller
{
    public function index()
    {
        $informations = PersonalInformation::all();
        //return $informations;
        return view('personalinformations.info', compact('informations'));
    }
    public function create()
    {
        return view('personalinformations.create');
    }
    public function store()
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:100'],
            'birthday' => ['required', 'min:5', 'max:13'],
            'phone_number' => ['required', 'min:1', 'max:13'],
            'email' => ['required', 'min:1', 'max:25'],
        ]);
        PersonalInformation::create(request(['name', 'address', 'birthday', 'phone_number', 'email']));
        return redirect('/personalinformations');
    }
    public function show(PersonalInformation $personalinformation)
    {
        return view('personalinformations.display', compact('personalinformation'));
    }
    public function edit(PersonalInformation $personalinformation)
    {
        return view('personalinformations.update', compact('personalinformation'));
    }
    public function update(PersonalInformation $personalinformation)
    {
        request()->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:100'],
            'birthday' => ['required', 'min:5', 'max:13'],
            'phone_number' => ['required', 'min:1', 'max:13'],
            'email' => ['required', 'min:1', 'max:25'],
        ]);
        $personalinformation->update(request(['name', 'address', 'birthday', 'phone_number', 'email']));
        return redirect('/personalinformations');
    }
    public function destroy(PersonalInformation $personalinformation)
    {
        $personalinformation->delete();
        return redirect('/personalinformations');
    }
}

*/