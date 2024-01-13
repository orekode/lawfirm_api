<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function proccessFilters( Request $request ) {

        $operator_map = [
            "in" => "like",
            "eq" => "=",
        ];

        $filters = $request->query();

        return $this->buildQueryConditions($filters, $operator_map);
        
    }

    public function buildQueryConditions($filters, $operator_map) {

        $query_conditions = [];

        foreach($filters as $prop => $filter)  {

            foreach($operator_map as $filter_key => $opp) {

                $value = $filter[$filter_key] ?? null;

                if(isset($value)) {

                    $value = $this->valuePreparation($opp, $value);
                    array_push($query_conditions, [$prop, $opp, $value]);

                }

            }
        }

        return $query_conditions;
    }

    public function valuePreparation($opp, $value) {
        
        if($opp == "like") {
            $value = "%$value%";
        } 

        return $value;
    }


}
