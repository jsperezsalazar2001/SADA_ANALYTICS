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
import copy

np.set_printoptions(precision=7)

def SteppedPartialPivot(matrix):
    matrix = np.array(matrix)
    dic = {}
    auxiliary_matrix = np.array(matrix)
    matrixDic = matrix.tolist()
    dic[0] = copy.deepcopy(matrixDic)
    temporal_array = []
    for i in range(matrix.shape[0]-1):
        pivot_number = auxiliary_matrix[0][0]
        if i == 0:
            for j in auxiliary_matrix:
                pivot_column = np.abs(j[:-1])
                temporal_maxpivot = np.max(pivot_column)
                temporal_array.append(temporal_maxpivot)
        sub_matrix = auxiliary_matrix.T[0]
        division_colum = np.abs(sub_matrix)/temporal_array[i:]
        posmax_pivot = np.where(division_colum == np.max(division_colum))[0][0]
        if(posmax_pivot != 0):
            pivot_number = auxiliary_matrix[posmax_pivot][0]
            temporal_matrix = np.array(auxiliary_matrix[0])
            auxiliary_matrix[0] = np.array(auxiliary_matrix[posmax_pivot])
            auxiliary_matrix[posmax_pivot] = temporal_matrix
            temporal_matrix = np.array(matrix[i])
            matrix[i]=np.array(matrix[i+posmax_pivot])
            matrix[i+posmax_pivot] = temporal_matrix
        if (pivot_number==0 and i == matrix.shape[0]-2):
            print ("the last pivot number is cero so the matrix doesn't have a solution")
        fj = auxiliary_matrix[0] # Fj
        column_vector = np.reshape(auxiliary_matrix.T[0][1:], (auxiliary_matrix.T[0][1:].shape[0], 1))
        multiplier = column_vector/pivot_number 
        fi = auxiliary_matrix[1:]              
        fi = fi - (multiplier*fj)
        if(i == 0):
            matrix[i+1:] = fi
        else:
            axiliary_fi = fi
            while (axiliary_fi.shape[1]+1 <matrix[i+1:].shape[1]):
                axiliary_fi =  np.insert(axiliary_fi, 0, np.zeros(1), axis=1)
            matrix[i+1:] = np.insert(axiliary_fi, 0, np.zeros(1), axis=1)
        auxiliary_matrix = fi.T[1:].T
        matrix = np.array(matrix)
        matrixDic = matrix.tolist()
        dic[i+1] = copy.deepcopy(matrixDic)
    a = np.delete(matrix, matrix.shape[1]-1, axis=1)
    b = matrix.T[matrix.shape[1]-1]
    return a,b,dic 

def initialData(A,b):
    A,b,matrix2 = matrix_function.mix_matrix(A,b)
    matrix2 = np.array(matrix2)
    A,B,dic = SteppedPartialPivot(matrix2)
    print(json.dumps(dic)) 
    x = matrix_function.soltion(A,B)
    x = x.tolist()
    xSolution = {}
    xSolution[0] = x
    print(json.dumps(xSolution)) 

#A = "[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]"
#b = "[1,1,1,1]"
A = sys.argv[1]
b = sys.argv[2]
initialData(A,b)