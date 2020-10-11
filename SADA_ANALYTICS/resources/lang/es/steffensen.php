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
        'f_function' => 'Ingrese f(x)',
        'initial_x' => 'Ingrese la x inicial',
        'tolerance' => 'Ingrese la tolerancia',
        'iterations' => 'Ingrese el máximo de iteraciones',
    ],
    'label' => [
        'f_function' => 'f(x)',
        'initial_x' => 'X inicial',
        'tolerance' => 'Tolerancia',
        'iterations' => 'Iteraciones',
    ],
    'calculate' => 'Calcular',
    'table' => [
        'iteration' => 'Iteración',
        'f_xi' => 'f(xi)',
        'xi' => 'xi',
        'xi_plus_f_xi' => 'xi + f(xi)',
        'f_xi_plus_f_xi' => 'f(xi + f(xi))',
        'error' => 'Error',
    ],
    'initial_data' => 'Datos inciales',
    'success' => 'Exito: el método convergió',
    'root' => 'Se encontró una aproximación de la raiz en: ',
    'no_root' => 'No se pudo encontrar una aproximación a una raíz con los datos dados',
];
