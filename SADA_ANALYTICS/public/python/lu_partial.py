"""
Created on Tue Nov  10 
This program finds the solution to the system Ax = b and the LU factorization of PA 
using the LU factorization method with partial pivoting Gaussian elimination.

Parameters
----------
A : Invertible matrix
b : Constant vector

Returns
-------
x : Solution
L : Factorization matrix L
U : Factorization matriz U
P : Factorization matrix P

@author: Juan Sebastián Pérez Salazar
"""

import numpy as np
import matrix_function

def lu_partial(A, b):
    n = len(A)
    u = np.zeros(A.shape)
    l = np.eye(n)
    p = np.eye(n)
    
    for k in range(n):
        print('step ', k)
        print(A)
        print('L step', k)
        print(l)

        A, p = searchBiggerandSwap(A, n, k, p)
       
        for i in range(k + 1, n):
            mult = A[i][k] / A[k][k]
            l[i][k] = mult
            for j in range(k, n):
                A[i][j] = A[i][j] - mult * A[k][j]

        print('u step', k)
        for i in range(n):
            u[k][i] = A[k][i]
        print(u)
        print('P step', k)
        print(p)
    pb = np.matmul(p, b)
    z = np.array(matrix_function.soltion(l, pb), float)
    x = matrix_function.soltion(u, z)
    
    print('z', z)
    print('x', x)
    
def searchBiggerandSwap(Ab, n, i, p):
    row = i

    for j in range(i + 1, n):
        if (abs(Ab[row][i]) < abs(Ab[j][i])):
            row = j
    
    temp = np.array(Ab[i])
    print(temp)
    aux = np.array(p[i])
    Ab[i] = Ab[row]
    p[i] = p[row]
    Ab[row] = temp
    print(Ab[row])
    p[row] = aux
   
    return Ab, p

A = np.array([[4, -1, 0, 3], [1,15.5,3,8], [0,-1.3,-4,1.1], [14,5,-2,30]])
b = [1,1,1,1]

lu_partial(A, b)