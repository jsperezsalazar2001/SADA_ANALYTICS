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
        'initial_x' => 'Initial \\space x',
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
    'root' => 'An aproximation to the root was found at: ',
    'no_root' => 'Could not find an aproximation to the root with the given data',
    'help' => 'Help',
    'help1' => 'F(x) must be continuos and differentiable',
    'help2' => 'To get a better result enter a good initial x',
    'help3' => 'Both tolerance and iterations must be positive',
    'help4' => 'If the table displays "zoo", "oo" or Nan, it means that there was an error calculating that value, either complex operations or division by 0',

];
