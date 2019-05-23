<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\PersonalInformation;

class PersonalInformationTransformer extends TransformerAbstract
{
    public function transform(PersonalInformation $personalInformation)
    {
        return [
            'id' => $personalInformation->id, 
            'name'=> $personalInformation->name, 
            'address'=> $personalInformation->address, 
            'birthday'=> $personalInformation->birthday, 
            'phone_number'=> $personalInformation->phone_number, 
            'email'=> $personalInformation->email
        ];
    }
}