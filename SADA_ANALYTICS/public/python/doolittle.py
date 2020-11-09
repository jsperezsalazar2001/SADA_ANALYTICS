import sympy as sm
import math
import sys
import json
import base64
import numpy as np

def soltion(a,b):
    correction = []
    b = b.tolist()
    b = np.array(b)
    if (str(b.tolist())[0:2] == '[['):
        b = str(b.tolist())[2:-2]
        array = b.split(",")
        for value in array:
            correction.append(float(value))
        b = correction
        correction = []
    x = np.linalg.inv(a).dot(b)
    x = x.tolist()
    x = np.array(x)
    if (str(x.tolist())[0:2] == '[['):
        x = str(x.tolist())[2:-2]
        array = x.split(",")
        for value in array:
            correction.append(float(value))
        x= correction
        correction = []
    final_value = np.array([],dtype=str)
    for result in x:
        final_value = np.append(final_value, '{:.7f}'.format(result))
    return final_value

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
    
    z = np.array(soltion(L,b),float)
    x = soltion(U,z)

    sol = []

    print("Arreglo X")
    for i in range(0,len(x)):
        sol.append(float(x[i]))
    print(sol)



            
doolittle([[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]],[1,1,1,1],4)