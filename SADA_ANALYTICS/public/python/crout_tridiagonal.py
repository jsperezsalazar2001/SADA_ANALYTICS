"""
Created on Nov 10
This program finds the solution of matrix a tridiagonal matrix A: Ax = B using 
first the tridiagonal crout factorization method
Parameters
----------
matrix: A
vector: b
Prints:
 - stages of the factorization process
 - answer to the system
This code does not support operations with imaginary numbers 

@author: Yhoan Alejandro Guzman Garcia
"""

import math 
import matrix_function
import numpy as np
import sys

def crout_tridiagonal(A,b):
    b = [b]
    npA = np.array(A)
    npb = np.array(b)
    npAb = np.concatenate((npA, npb.T), axis=1)
    if np.linalg.det(npA) == 0:
        print("Determinant equal to 0, the method can not run")
        sys.exit(1)
    n = len(A)
    L = [[0 for x in range(n)]  
                for y in range(n)]
    U = [[0 for x in range(n)]  
                for y in range(n)]
    for i in range(len(U)):
        U[i][i] = 1
    for i in range(len(L)):
        L[i][i] = 1
    Z = [None for x in range(n)]
    step = 0
    print("Step: "+str(step))
    print("A:")
    print_matrix(A)
    step = 1
    L[0][0] = npAb[0][0]
    U[0][1] = npAb[0][1]/L[0][0]
    Z[0] = npAb[0][n]/L[0][0]
    for i in range(1,n-1):
        L[i][i-1] = npAb[i][i-1]
        L[i][i] =  npAb[i][i]-L[i][i-1]*U[i-1][i]
        U[i][i+1] = npAb[i][i+1]/L[i][i]
        Z[i] = (npAb[i][n] - L[i][i-1]*Z[i-1])/L[i][i]
        print("Step: "+str(step))
        print("L:")
        print_matrix(L)
        print("U:")
        print_matrix(U)
        step += 1
    L[n-1][n-1-1] = npAb[n-1][n-1-1]
    L[n-1][n-1] =  npAb[n-1][n-1]-L[n-1][n-1-1]*U[n-1-1][n-1]
    Z[n-1] = (npAb[n-1][n+1-1] - L[n-1][n-1-1]*Z[n-1-1])/L[n-1][n-1]

    b = np.array(b)
    z = np.array(matrix_function.soltion(L,b),float)
    x = matrix_function.soltion(U,z)
    print("Solution")
    print(x)

def print_matrix(matrix):
    n = len(matrix)
    for i in range(n):  
        for j in range(n): 
            print(matrix[i][j], end = "\t")
        print("")

matrix = [[2, -1, 0, 0],
          [-1, 2, -1, 0],
          [0, -1, 2, -1],
          [0, 0, -1, 2]]
b = [1,0,0,1]

crout_tridiagonal(matrix, b)
