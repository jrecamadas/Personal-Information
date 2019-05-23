<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Facades\Request;

class PersonalInformationValidator  extends LaravelValidator
{
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);

        $this->setRules([
            ValidatorInterface::RULE_CREATE => [
                //'employee_no' => 'required|unique:employees,employee_no',
                'name' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'phone_number' => 'required',
                'email' => 'required'
            ],
            ValidatorInterface::RULE_UPDATE => [
                //'employee_no' => 'unique:employees,employee_no,' . Request::route('employee')
            ]
        ]);
    }
}