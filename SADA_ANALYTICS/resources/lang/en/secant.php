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

    'title' => 'Secant method',
    'input' => [
        'f_function' => 'Enter f(x)',
        'x1' => 'Enter x1',
        'x2' => 'Enter x2',
        'tolerance' => 'Enter the tolerance',
        'iterations' => 'Enter the maximun iterations',
    ],
    'label' => [
        'f_function' => 'f(x)',
        'x1' => 'X1',
        'x2' => 'X2',
        'tolerance' => 'Tolerance',
        'iterations' => 'Iterations',
    ],
    'calculate' => 'Calculate',
    'table' => [
        'iteration' => 'Iteration',
        'xi' => 'xi',
        'f_xi' => 'f(xi)',
        'error' => 'Error',
    ],
    'initial_data' => 'Initial Data',
    'success' => 'Success: the method converged',
    'root' => 'An aproximation to the root was found at: ',
    'no_root' => 'Could not find an aproximation to the root with the given data',
];