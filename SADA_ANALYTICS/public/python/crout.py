"""
Created on Tue Nov  10 
This program finds the solution to the system Ax = b and the LU factorization of A 
using the Crout method.

Parameters
----------
A : Invertible matrix
b : Constant vector

Returns
-------
x : Solution
L : Factorization matrix L
U : Factorization matriz U


@author: Juan Sebastián Pérez Salazar
"""

import numpy as np
import matrix_function as mf

def crout(A,b):
    A = np.array(A)
    b = np.array(b)
    n = len(A)
    L = np.eye(n)
    U = np.eye(n)
    print("Etapa 0:")
    print("Matriz L: ")
    print(L)
    print("Matriz U: ")
    print(U)
    for i in range(n):
        print("Etapa " + str(i+1))
        for k in range(i, n): 
            suma = 0;
            for j in range(i):
                suma += (L[k][j] * U[j][i]);
            L[k][i] = A[k][i] - suma;
        for k in range(i, n):
            if (i == k):
                U[i][i] = 1;
            else:
                suma = 0;
                for j in range(i):
                    suma += (L[i][j] * U[j][k]);
                U[i][k] = ((A[i][k] - suma)/L[i][i]);
        print("Matriz L: ")
        print(L)
        print("Matriz U: ")
        print(U)
    
    z = np.array(mf.soltion(L,b),float)
    x = mf.soltion(U,z)

    sol = []

    print("Arreglo X")
    for i in range(0,len(x)):
        sol.append(float(x[i]))
    print(sol)
    
A = [[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]
b = np.array([1,1,1,1]).T

crout(A, b)