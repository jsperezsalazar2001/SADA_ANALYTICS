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

    'title' => 'Iterative methods',
    'dimension' => '\[Dimension \]',
    'create_matrix' => 'Create a matrix and choose input parameters',
    'separator' => '------------------------------------------------------',
    'input' => [
        'dimension' => 'Dimension',
        'jacobi_method' => 'Jacobi method',
        'gauss_seidel_method' => 'Gauss Seidel method',
        'sor' => 'Sor method',
        'tolerance' => '\[Tolerance \]',
        'iteration' => '\[Iteration \]',
        'w' => '\[W \]',
    ],
    'label' => [
        'matrix_a' => '\[Matrix \\space A \]',
        'vector_b' => '\[Vector \\space B \]',
        'vector_x' => '\[Vector \\space X0 \]',
        'x_solution' => '\[X \\space solutions \]',
        'tolerance' => 'Tolerance',
        'iteration' => 'Iteration number',
        't' => 'T',
        'method_type' => '\[Method \\space type\]',
    ],
    'table' => [
        'iteration' => '\[ Iteration \]',
        'error' => '\[ Error \]',
        'point' => '\[ Points \]',
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