<?php    

use App\Models\Groups;
use App\Models\Users;
use App\Models\Models;
use App\Models\Fuel;
use App\Models\Drivetrain;
use App\Models\Transmission;
use App\Models\Bodytype;
use App\Models\Make;
use App\Models\Province;
function isUppercase($value, $message, $fail){
    if ($value!=mb_strtoupper($value, 'UTF-8')){
        $fail($message);
    }
}
function getAllGroups(){
    $groups = new Groups; 
    return $groups->getAll();
}
function getAllUsers(){
    $users = new Users; 
    return $users->getAllUsers();
}

function getAllModels(){
    $model = new Models; 
    return $model->getAll();
}

function getAllFuel(){
    $fuel = new Fuel; 
    return $fuel->getAll();
}
function getAllDrivetrain(){
    $drivetrain = new Drivetrain; 
    return $drivetrain->getAll();
}

function getAllTransmission(){
    $transmission = new Transmission; 
    return $transmission->getAll();
}

function getAllBodytype(){
    $bodytype = new Bodytype; 
    return $bodytype->getAll();
}

function getAllMake(){
    $make = new Make; 
    return $make->getAll();
}


function getAllProvince(){
    $province = new Province; 
    return $province->getAll();
}


