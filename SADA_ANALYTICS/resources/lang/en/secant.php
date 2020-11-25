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
        'x1' => 'Enter x0',
        'x2' => 'Enter x1',
        'tolerance' => 'Enter the tolerance',
        'iterations' => 'Enter the maximun iterations',
    ],
    'label' => [
        'f_function' => 'f(x)',
        'x1' => 'X0',
        'x2' => 'X1',
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
    'help' => 'Help',
    'help1' => 'F(x) must be continuos and differentiable',
    'help2' => 'To get a faster result  X1 and X2 must be close to the root',
    'help3' => 'Both tolerance and iterations must be positive',
    'help4' => 'If the table displays "zoo", "oo" or Nan, it means that there was an error calculating that value, either complex operations or division by 0',
    'help5' => 'If you get an error regarding the expression, make sure that you used, for instance, x*(ln(x)) instead of x(ln(x)) ',
];