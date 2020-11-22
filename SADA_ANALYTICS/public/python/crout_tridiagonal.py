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
import copy
import json
import parser_input_helper
def crout_tridiagonal(A,b):
    answer = {}
    answer["error"] = False
    dict_A = {}
    dict_L = {}
    dict_U = {}
    dict_X = {}
    try:
        npA,b = parser_input_helper.parse_input(A,b)
        dict_A[0] = parser_input_helper.rebuild_matrix(copy.deepcopy(npA))
        npb = list(b)
        npb = [npb]
        npb = np.array(npb)
        npAb = np.concatenate((npA, npb.T), axis=1)
        if np.linalg.det(npA) == 0: 
            raise Exception("Derterminant can not be 0")
        n = len(npA)
        L = [[0.0 for x in range(n)]  
                    for y in range(n)]
        U = [[0.0 for x in range(n)]  
                    for y in range(n)]
        for i in range(len(U)):
            U[i][i] = 1.0
        for i in range(len(L)):
            L[i][i] = 1.0
        L = np.array(L) 
        U = np.array(U) 
        Z = [None for x in range(n)]
        step = 1
        L[0][0] = npAb[0][0]
        U[0][1] = npAb[0][1]/L[0][0]
        Z[0] = npAb[0][n]/L[0][0]
        for i in range(1,n-1):
            L[i][i-1] = npAb[i][i-1]
            L[i][i] =  npAb[i][i]-L[i][i-1]*U[i-1][i]
            U[i][i+1] = npAb[i][i+1]/L[i][i]
            Z[i] = (npAb[i][n] - L[i][i-1]*Z[i-1])/L[i][i]
            dict_L[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(L))
            dict_U[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(U))
            step += 1
        L[n-1][n-1-1] = npAb[n-1][n-1-1]
        L[n-1][n-1] =  npAb[n-1][n-1]-L[n-1][n-1-1]*U[n-1-1][n-1]
        dict_L[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(L))
        dict_U[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(U))
        Z[n-1] = (npAb[n-1][n+1-1] - L[n-1][n-1-1]*Z[n-1-1])/L[n-1][n-1]
        # z = np.array(matrix_function.soltion(L,b),float)
        # x = matrix_function.soltion(U,z)
        x2 = [0.0 for x in range(n)]
        x2[len(x2)-1] = Z[len(Z)-1]
        final_x = np.array([],dtype=str)
        final_x = np.append(final_x, '{:.7f}'.format(x2[len(x2)-1]))
        for i in reversed(range(len(Z)-1)):
            x2[i] = float(Z[i]) - float(U[i][i+1]) * float(x2[i+1])
            final_x = np.append(final_x, '{:.7f}'.format(x2[i]))
    except ValueError as valueError:
        answer["error"] = "A complex operation was encounter while running the method"
    except BaseException as e:
        answer["error"] = str(e)
    print(json.dumps(answer))
    print(json.dumps(dict_A) )
    print(json.dumps(dict_L))
    print(json.dumps(dict_U))
    try:
        dict_X["solution"] = list(final_x)
        print(json.dumps(dict_X))
    except NameError:
        pass
# matrix = [[2, -1, 0, 0],
#           [-1, 2, -1, 0],
#           [0, -1, 2, -1],
#           [0, 0, -1, 2]]
# b = [1,0,0,1]
matrix = "[[2,-1,0,0],[-1,2,-1,0],[0,-1,2,-1],[0,0,-1,2]]"
b = "[1,1,1,1]"

# matrix = "[[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0]]"
# b = "[1,1,1,1]"
crout_tridiagonal(matrix, b)
# scrout_tridiagonal(sys.argv[1],sys.argv[2])
