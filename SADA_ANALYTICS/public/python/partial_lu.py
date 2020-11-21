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


def partial_lu(A, b):
    dic_a = {}
    dic_l = {}
    dic_u = {}
    dic_p = {}
    
    A = np.array(A)
    b = np.array(b)[0]
    
    n = len(A)
    u = np.zeros(A.shape)
    l = np.eye(n)
    p = np.eye(n)
    
    for k in range(n):
        #print('step ', k)
        #print(A)
        #print('L step', k)
        #print(l)
        dic_a[k] = np.array(A)
        dic_l[k] = np.array(l)

        A, p = searchBiggerandSwap(A, n, k, p)
       
        for i in range(k + 1, n):
            mult = A[i][k] / A[k][k]
            l[i][k] = mult
            for j in range(k, n):
                A[i][j] = A[i][j] - mult * A[k][j]

        #print('u step', k)
        for i in range(n):
            u[k][i] = A[k][i]
        #print(u)
        #print('P step', k)
        #print(p)
        dic_u[k] = np.array(u)
        dic_p[k] = np.array(p)
    pb = np.matmul(p, b.T)
    
    return l,u,pb,dic_a,dic_l,dic_u,dic_p
    
    """z = np.array(matrix_function.soltion(l, pb), float)
    x = matrix_function.soltion(u, z)
    
    print('z', z)
    print('x', x)"""
    
def searchBiggerandSwap(Ab, n, i, p):
    row = i

    for j in range(i + 1, n):
        if (abs(Ab[row][i]) < abs(Ab[j][i])):
            row = j
    
    temp = np.array(Ab[i])
    aux = np.array(p[i])
    Ab[i] = Ab[row]
    p[i] = p[row]
    Ab[row] = temp
    p[row] = aux
   
    return Ab, p

A = np.array([[4, -1, 0, 3], [1,15.5,3,8], [0,-1.3,-4,1.1], [14,5,-2,30]])
b = [1,1,1,1]
