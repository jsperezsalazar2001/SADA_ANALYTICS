"""
Created on Nov 10
This program interpolates using the cubic spline method
Parameters
----------
vector: x
vector: y
Prints:
 - coefitiens
 - tracers
This code does not support operations with imaginary numbers 

@author: Yhoan Alejandro Guzman Garcia
"""
import math 
import matrix_function
import numpy as np
import sys
import total_gaussian_method
def cubic_spline(x,y):
    if list_has_duplicates(x):
        print("X has duplicates")
        sys.exit(1)
    if list_has_duplicates(y):
        print("Y has duplicates")
        sys.exit(1)
    if len(x) != len(y):
        print("X and Y have different lengths")
        sys.exit(1)
    n = len(x)
    m = (n - 1) * 4
    A = q = [ [ 0 for i in range(m) ] for j in range(m) ]
    B = [0]*m
    A[0][0] = math.pow(x[0], 3)
    A[0][1] = math.pow(x[0], 2)
    A[0][2] = x[0]
    A[0][3] = 1
    B[0] = y[0]
    #interpolation conditions
    for i in range(n-1):
        A[i+1][4*(i+1)-4] = math.pow(x[i+1], 3)
        A[i+1][4*(i+1)-3] = math.pow(x[i+1], 2)
        A[i+1][4*(i+1)-2] = x[i+1]
        A[i+1][4*(i+1)-1] = 1
        B[i+1] = y[i+1]
    #continuity conditions
    for i in range(1, n-1):
        A[n-1+i][4*i-4] = math.pow(x[i], 3)
        A[n-1+i][4*i-3] = math.pow(x[i], 2)
        A[n-1+i][4*i-2] = x[i]
        A[n-1+i][4*i-1] = 1
        A[n-1+i][4*i] = -math.pow(x[i], 3)
        A[n-1+i][4*i+1] = -math.pow(x[i], 2)
        A[n-1+i][4*i+2] = -x[i]
        A[n-1+i][4*i+3] = -1
        B[n-1+i] = 0
    #softness condition
    for i in range(1, n-1):
        A[2*n-3+i][4*i-4] = 3 * math.pow(x[i], 2)
        A[2*n-3+i][4*i-3] = 2 * x[i]
        A[2*n-3+i][4*i-2] = 1
        A[2*n-3+i][4*i-1] = 0
        A[2*n-3+i][4*i] = -3 * math.pow(x[i], 2)
        A[2*n-3+i][4*i+1] = -2 * x[i]
        A[2*n-3+i][4*i+2] = -1
        A[2*n-3+i][4*i+3] = 0
        B[2*n-3+i] = 0
    #concavity conditions
    for i in range(1, n-1):
        A[3*n-5+i][4*i-4] = 6 * x[i]
        A[3*n-5+i][4*i-3] = 2
        A[3*n-5+i][4*i-2] = 0
        A[3*n-5+i][4*i-1] = 0
        A[3*n-5+i][4*i]   = -6 * x[i]
        A[3*n-5+i][4*i+1] = -2
        A[3*n-5+i][4*i+2] = 0
        A[3*n-5+i][4*i+3] = 0
        B[n+5+i]= 0
    #boundary conditions
    A[m-2][0] = 6 * x[0]
    A[m-2][1] = 2
    A[m-1][m-4] = 6 * x[n-1]
    A[m-1][m-3] = 2

    print("A")
    A = np.array(A)
    print(A)
    print("B")
    print(B)
    x = np.linalg.solve(A, B)
    print("Coefitiens")
    print(x)

    # for i in range(len(x)/3):
    #     print(str(x[i*3])
def list_has_duplicates(input_list):
    list_set = set(input_list)
    contains_duplicates = len(list_set) != len(input_list)
    return contains_duplicates
cubic_spline([-1,0,3,4],[15.5,3,8,1])