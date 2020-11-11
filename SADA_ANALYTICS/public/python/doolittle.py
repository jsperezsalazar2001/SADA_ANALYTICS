"""
Created on Tue Nov  10 
This program finds the solution to the system Ax = b and the LU factorization of A 
using the Doolittle method.

Parameters
----------
A : Invertible matrix
b : Constant vector

Returns
-------
x : Solution
L : Factorization matrix L
U : Factorization matriz U


@author: Cesar Andres Garcia Posada
"""

import sympy as sm
import math
import sys
import json
import base64
import numpy as np
import matrix_function

def doolittle(A,b,size):
    A = np.array(A)
    b = np.array(b)
    L = np.eye(size)
    U = np.eye(size)
    print("Etapa 0:")
    print("Matriz L: ")
    print(L)
    print("Matriz U: ")
    print(U)
    for i in range(size):
        print("Etapa " + str(i+1))
        for k in range(i, size): 
            suma = 0;
            for j in range(i):
                suma += (L[i][j] * U[j][k]);
            U[i][k] = A[i][k] - suma;
        for k in range(i, size):
            if (i == k):
                L[i][i] = 1;
            else:
                suma = 0;
                for j in range(i):
                    suma += (L[k][j] * U[j][i]);
                L[k][i] = ((A[k][i] - suma)/U[i][i]);
        print("Matriz L: ")
        print(L)
        print("Matriz U: ")
        print(U)
    
    z = np.array(matrix_function.soltion(L,b),float)
    x = matrix_function.soltion(U,z)

    sol = []

    print("Arreglo X")
    for i in range(0,len(x)):
        sol.append(float(x[i]))
    print(sol)

          
doolittle([[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]],[1,1,1,1],4)