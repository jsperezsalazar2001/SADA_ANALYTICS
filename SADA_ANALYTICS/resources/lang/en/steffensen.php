<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'title' => "Steffensen's method",
    'input' => [
        'f_function' => 'Enter f(x)',
        'initial_x' => 'Enter the initial x',
        'tolerance' => 'Enter the tolerance',
        'iterations' => 'Enter the maximun iterations',
    ],
    'label' => [
        'f_function' => 'f(x)',
        'initial_x' => 'Initial x',
        'tolerance' => 'Tolerance',
        'iterations' => 'Iterations',
    ],
    'calculate' => 'Calculate',
    'table' => [
        'iteration' => 'Iteration',
        'f_xi' => 'f(xi)',
        'xi' => 'xi',
        'xi_plus_f_xi' => 'xi + f(xi)',
        'f_xi_plus_f_xi' => 'f(xi + f(xi))',
        'error' => 'Error',
    ],
    'initial_data' => 'Initial Data',
    'success' => 'Success: the method converged',
];
