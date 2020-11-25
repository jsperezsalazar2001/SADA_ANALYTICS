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

    'title' => 'Cholesky',
    'dimension' => 'Dimension',
    'create_matrix' => 'Create a matrix',
    'separator' => '------------------------------------------------------',
    'label' => [
        'matrix_a' => 'Matrix A',
        'vector_b' => 'Vector B',
        'x_solution' => 'X solutions',
        'step' => 'Step',
        'method_type' => 'Method type',
    ],
    'solve' => 'Solve',
    'solution' => 'Solution',
    'step' => 'Step',
    'help_list' => [
        'fail' => 'This program does not support complex operations, which makes the Cholesky method very likely to fail because it uses the square root of a substraction.',
        'dimension' => 'In the input dimension you choose the dimension n to the matrix nxn.',
        'example'=>'Matrix 3x3 example',
        'fill' => 'Make sure all the fields in the array are filled.',
        'determinant' => 'The determinant of the matrix must not be 0. The most common case where the determinant is equals to 0 is because two rows are identical so take care with that.',
    ],
];