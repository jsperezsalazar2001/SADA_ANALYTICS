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

    'title' => 'Gaussian elimination methods',
    'dimension' => '\[Dimension \]',
    'create_matrix' => 'Create a matrix',
    'separator' => '------------------------------------------------------',
    'input' => [
        'simple_gaussian_method' => 'Simple Gaussian Method',
        'partial_gaussian_method' => 'Partial Gaussian Method',
        'total_gaussian_method' => 'Total Gaussian Method',
        'tridiagonal_matrices_method' => 'Tridiagonal Matrices',
        'stepped_partial_method' => 'Stepped Partial Gaussian Method'
    ],
    'label' => [
        'matrix_a' => '\[Matrix \\space A \]',
        'vector_b' => '\[Vector \\space B \]',
        'x_solution' => '\[X \\space solutions \]',
        'step' => 'Step',
        'method_type' => '\[Method \\space type \]',
    ],
    'help' => 'Help',
    'matrix_dimension'=> 'Matrix dimension',
    'help_list' => [
        'dimension' => 'In the input dimension you choose the dimension n to the matrix nxn.',
        'example'=>'Matrix 3x3 example',
        'fill' => 'Make sure all the fields in the array are filled.',
        'determinant' => 'The most common case where the determinant is equals to 0 is because two rows are identical so take care with that.',
    ],
    'solve' => 'Solve',
    'save' => 'Save Matrix after calculating',
];