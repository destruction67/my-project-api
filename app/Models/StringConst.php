<?php

namespace App\Models;

class StringConst
{
    const ERROR_CONFLICT_AUTH_MSG = [
        'errors' => [
            'message' => 'Incorrect username or password',
        ],
    ];

    const ERROR_INACTIVE_USER = [
        'errors' => [
            'message' => 'This account is inactive. Please contact the administrator.',
        ],
    ];

    const ERROR_RECORD_EXIST = [
        'errors' => [
            'message' => 'Record already exist',
        ]
    ];

    const ERROR_RECORD_NOT_FOUND = [
        'errors' => [
            'message' => 'Record not found',
        ]
    ];

    const ERROR_SERVICE_UNAVAILABLE = [
        'errors' => [
            'message' => 'Service unavailable this time.'
        ]
    ];

    const ERROR_EXCEPTION_ERROR = [
        'errors' => [
            'message' => 'Exception Error'
        ]
    ];


    const ACTIVE = 1;
    const INCORRECT_CREDENTIALS = 2;
    const INACTIVE_USER = 0;




}
