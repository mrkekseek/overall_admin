<?php

namespace App\Http\Controllers;

class CallsController extends Controller
{
    public function ssocals()
    {
        $calls =[ 
            [
                'number' => 1, 
                'id' => 'Accounts', 
                'name' => 'GET /api/Accounts', 
                'method' => 'GET', 
                'fields'=> [
                    'Id'
                ],
            ],
            /*
            [
                'number' => 2, 
                'id' => 'AccountsGetAll', 
                'name' => 'GET /api/Accounts/GetAll', 
                'method' => 'GET', 
                'fields'=> [
                    'Id'
                ],
            ],
             */
            [
                'number' => 3, 
                'id' => 'AccountsId', 
                'name' => 'GET /api/Accounts/{id}', 
                'method' => 'GET', 
                'fields'=> [
                    'Id'
                ],
            ],
            [
                'number' => 4,
                'id' => 'AccountsGetByUsername', 
                'name' => 'GET /api/Accounts/GetByUsername', 
                'method' => 'GET', 
                'fields'=> [
                    'username'
                ],
            ],
            [
                'number' => 5,
                'id' => 'AccountsGetByPhoneNumber', 
                'name' => 'GET /api/Accounts/GetByPhoneNumber', 
                'method' => 'GET', 
                'fields'=> [
                    'phoneNumber'
                ],
            ],
            [
                'number' => 6,
                'id' => 'AccountsGetByEmail', 
                'name' => 'GET /api/Accounts/GetByEmail', 
                'method' => 'GET', 
                'fields'=> [
                    'emailAddress'
                ],
            ],
            [
                'number' => 7,
                'id' => 'AccountsCheckIfExists', 
                'name' => 'GET /api/Accounts/CheckIfExists', 
                'method' => 'GET', 
                'fields'=> [
                    'username'
                ],
            ],
            [
                'number' => 8,
                'id' => 'AccountsResetPassword', 
                'name' => 'GET /api/Accounts/ResetPassword', 
                'method' => 'GET', 
                'fields'=> [
                    'username'
                ],
            ],
            [
                'number' => 9,
                'id' => 'AccountsGetAccountWithActivities', 
                'name' => 'GET /api/Accounts/GetAccountWithActivities/{id}', 
                'method' => 'GET', 
                'fields'=> [
                    'id'
                ],
            ],
            [
                'number' => 10,
                'id' => 'EnumsGetActivities', 
                'name' => 'GET /api/Enums/GetActivities', 
                'method' => 'GET', 
                'fields'=> [
                    'id'
                ],
            ],
        ];
        return compact('calls');
    }
    
    public function send($id = FALSE, $data = [])
    {
        $data = array_only($data, ['method','func','data']);
        parse_str($data['data'],$dataForApi);
        $dataForApi = array_except($dataForApi, '_token');
        
        if ($data['method'] == 'GET')
        {
            $dataForApi = count($dataForApi) ? '?'.http_build_query($dataForApi) : 0;
        }
        
        $apiAuth = app()->make('\App\Http\Libraries\ApiAuth');
        
        if (method_exists($apiAuth, $data['func']))
        {
            $result = call_user_func('\App\Http\Libraries\ApiAuth::'.$data['func'],$dataForApi);
            return [
                'success' => TRUE,
                'response' => $result,
            ];
        }
        else
        {
            return [
                'success' => FALSE,
                'response' => 'Method '.$data['func'].' not found',
            ];
        }
    }
    
}
