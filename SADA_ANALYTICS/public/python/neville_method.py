
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
import json
def neville(data, dimension, x_inter):
    error = {}
    error[0] = False
    answer = {}
    try:
        dimension = int(dimension)
        data = data.replace('[', '').replace(']', '').split(',')
        x = []
        y = []
        for i in range(len(data)):
            if i < int(dimension):
                x.append(float(data[i]))
            else:
                y.append(float(data[i]))

        x_inter = float(x_inter)
        if list_has_duplicates(x):
            raise Exception("X coordinates contain a duplicate")
        # if list_has_duplicates(y):
        #     raise Exception("Y coordinates contain a duplicate")
        if len(x) != len(y):
            raise Exception("X and Y coordinates do not have the same length")
        n = len(x)
        x = np.array(x)
        y = np.array(y)
        Q = np.zeros((n,n-1))
        Q = np.concatenate((y[:, None], Q), axis=1)
        for i in range(1, n):
            for j in range(1, i + 1):
                Q[i,j] = ((x_inter-x[i-j])*Q[i,j-1]-(x_inter-x[i])*Q[i-1,j-1])/(x[i]-x[i-j])
        y_int = round(Q[n-1,n-1],7)
    except ValueError as valueError:
        error[0] = "A complex operation was encounter while running the method"
    except BaseException as e:
        error[0] = str(e)
    print(json.dumps(error))
    try:
        answer[0] = y_int
        print(json.dumps(answer))
    except BaseException:
        pass
def list_has_duplicates(input_list):
    list_set = set(input_list)
    contains_duplicates = len(list_set) != len(input_list)
    return contains_duplicates
# neville("[2.0,2.2,2.3,0.693147,0.788457,0.832909]","3", "2.1")
neville(sys.argv[1],sys.argv[2], sys.argv[3])