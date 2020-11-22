"""
Created on Nov 10
This program finds the solution of matrix Ax = B using first the cholesky factorization method
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
def cholesky(A,b):
    answer = {}
    answer["error"] = False
    dict_A = {}
    dict_L = {}
    dict_U = {}
    dict_X = {}
    try:
        A,b = parser_input_helper.parse_input(A,b)
        dict_A[0] = parser_input_helper.rebuild_matrix(copy.deepcopy(A))
        if np.linalg.det(A) == 0: 
            raise Exception("Derterminant can not be 0")
        n = len(A)
        L = [[0.0 for x in range(n)]  
                    for y in range(n)]
        U = [[0.0 for x in range(n)]  
                    for y in range(n)]
        L = np.array(L) 
        U = np.array(U) 
        step = 1
        for k in range(n):
            sum1 = 0.0
            for i in range(n):
                sum1 += L[k][i] * U[i][k]
            L[k][k] = math.sqrt(A[k][k] - sum1)
            U[k][k] = L[k][k]
            for i  in range(k + 1, n):
                sum2 = 0.0
                for p in range(k):
                    sum2 += L[i][p] * U[p][k]
                L[i][k] = (A[i][k] - sum2) / U[k][k]
            for j in range(k + 1, n):
                sum3 = 0.0
                for p in range(k):
                    sum3 += L[k][p] * U [p][j]
                U[k][j] = (A[k][j] - sum3) / L[k][k]
            
        # print("Step 0")
        # npA = np.array(A) 
        # dict_A[0] = rebuild_matrix(copy.deepcopy(npA))
        # print(dict_A[0])
            dict_L[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(L))
            dict_U[step] = parser_input_helper.rebuild_matrix(copy.deepcopy(U))
            step += 1
        z = np.array(matrix_function.soltion(L,b),float)
        x = matrix_function.soltion(U,z)
    except ValueError as valueError:
        answer["error"] = "A complex operation was encounter while running the method"
    except BaseException as e:
        answer["error"] = str(e)
    print(json.dumps(answer))
    print(json.dumps(dict_A))
    print(json.dumps(dict_L))
    print(json.dumps(dict_U))
    try:
        dict_X["solution"] = list(x)
        print(json.dumps(dict_X))
    except BaseException:
        pass

# matrix = "[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]"
# b = "[1,1,1,1]"
# matrix = "[[2,1,0,0],[-1,2,-1,0],[0,-1,2,-1],[0,0,-1,2]]"
# b = "[1,1,1,1]"
# cholesky(matrix,b)
# matrix = "[[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0]]"
# b = "[1,1,1,1]"
# cholesky(matrix,b)
# cholesky("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]")

# matrix = "[[2,1,0,0],[-1,2,-1,0],[0,-1,2,-1],[0,0,-1,2]]"
# b = "[1,1,1,1]"
# cholesky(matrix,b)

# matrix = "[[2,2],[2,4]]"
# b = "[2,2]"
# cholesky(matrix,b)

cholesky(sys.argv[1],sys.argv[2])