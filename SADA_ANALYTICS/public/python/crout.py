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
import json
import sys

def crout(A,b):
    A,b,matrix = mf.mix_matrix(A,b)
    
    A = np.array(A)
    b = np.array(b)
    n = len(A)
    L = np.eye(n)
    U = np.eye(n)

    dic_a = {}
    dic_l = {}
    dic_u = {}

    dic_a[0] = np.array(A)
    dic_l[0] = np.array(L)
    dic_u[0] = np.array(U)

    for i in range(n):
        for k in range(i, n): 
            suma = 0
            for j in range(i):
                suma += (L[k][j] * U[j][i])
            L[k][i] = A[k][i] - suma
        for k in range(i, n):
            if (i == k):
                U[i][i] = 1
            else:
                suma = 0
                for j in range(i):
                    suma += (L[i][j] * U[j][k])
                U[i][k] = ((A[i][k] - suma)/L[i][i])
        
        dic_a[i+1] = np.array(A)
        dic_l[i+1] = np.array(L)
        dic_u[i+1] = np.array(U)
    
    z = np.array(mf.soltion(L,b),float)
    x = mf.soltion(U,z)

    sol = []

    for i in range(0,len(x)):
        sol.append(float(x[i]))
    solution = {}
    solution[0] = sol
    dic_a = mf.rebuild_matrix(dic_a)
    dic_l = mf.rebuild_matrix(dic_l)
    dic_u = mf.rebuild_matrix(dic_u)
    print(json.dumps(solution)) 
    print(json.dumps(dic_a))   
    print(json.dumps(dic_l))   
    print(json.dumps(dic_u))   


"""A = [[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]
b = np.array([1,1,1,1]).T

crout(A, b)"""
#x = crout("[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]","[1,1,1,1]")
crout(sys.argv[1],sys.argv[2])