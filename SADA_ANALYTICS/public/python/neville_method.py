
"""
Created on Nov 10
This program interpolates using Neville's method
Parameters
----------
vector: x
vector: y
point (float): x_inter : Value to interpolate
Prints:
y_inter: Interpolated value
Q: Coefficients matrix
This code does not support operations with imaginary numbers 

@author: Yhoan Alejandro Guzman Garcia
"""
import math 
import matrix_function
import numpy as np
import sys
import total_gaussian_method
def neville(x, y, x_inter):
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
    x = np.array(x)
    y = np.array(y)
    Q = np.zeros((n,n-1))
    Q = np.concatenate((y[:, None], Q), axis=1)
    for i in range(1, n):
        for j in range(1, i + 1):
            Q[i,j] = ((x_inter-x[i-j])*Q[i,j-1]-(x_inter-x[i])*Q[i-1,j-1])/(x[i]-x[i-j])
    y_int = Q[n-1,n-1]
    print(y_int)
    print(Q)
    return y_int


def list_has_duplicates(input_list):
    list_set = set(input_list)
    contains_duplicates = len(list_set) != len(input_list)
    return contains_duplicates
neville([2.0,2.2,2.3],[0.693147,0.788457,0.832909], 2.1)