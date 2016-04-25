<?php

return array(

    'multi' => array(
        'admin' => array(
            'driver' => 'database',
            'table' => 'admins'
        ),
        'teacher' => array(
            'driver' => 'database',
            'table' => 'teachers'
        ),
        
        'father' => array(
            'driver' => 'database',
            'table' => 'fathers'
        ),
         'account' => array(
            'driver' => 'database',
            'table' => 'accounts'
        )

    ),

    'reminder' => array(

        'email' => 'emails.auth.reminder',

        'table' => 'password_reminders',

        'expire' => 60,

    ),


);