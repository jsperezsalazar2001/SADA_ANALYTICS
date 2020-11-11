import math 
import matrix_function
import numpy as np
import sys

def cholesky(A,b):
    npA = np.array(A) 
    if np.linalg.det(npA) == 0:
        print("Determinant equal to 0, the method can not run")
        sys.exit(1)
    n = len(A)
    L = [[0 for x in range(n)]  
                for y in range(n)]
    U = [[0 for x in range(n)]  
                for y in range(n)]
    # for i in range(n):
    #     L[i][i] = 1
    #     U[i][i] = 1
    # print("L")
    # print_matrix(L)
    # print("U")
    # print_matrix(U)
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
        
        print("Step: "+str(step))
        print("L")
        print_matrix(L)
        print("U")
        print_matrix(U)
        step += 1
    b = np.array(b)
    z = np.array(matrix_function.soltion(L,b),float)
    x = matrix_function.soltion(U,z)
    print(x)

def print_matrix(matrix):
    n = len(matrix)
    for i in range(n):  
        for j in range(n): 
            print(matrix[i][j], end = "\t")
        print("")

matrix = [[4, 12, -16],
          [12, 37, -43],
          [-16, -43, 98]]
b = [1,1,1]

cholesky(matrix, b)
#DETERMINANTE DIFERENTE DE CERO