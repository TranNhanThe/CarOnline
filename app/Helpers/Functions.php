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
use App\Models\Ad_rent;
use App\Models\AdType;
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
    return $model->getAllModel();
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
    return $make->getAllMake();
}

function getAMake(){
    $make = new Make; 
    return $make->getA();
}


function getAllProvince(){
    $province = new Province; 
    return $province->getAll();
}

function getAllAd_rent(){
    $ad_rent = new Ad_rent; 
    return $ad_rent->getAll();
}

function getAllAdtype(){
    $adtype = new AdType; 
    return $adtype->getAll();
}


