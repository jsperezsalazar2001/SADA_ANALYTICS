"""
Created on Tue Oct  6
This program found the solution of matrix Ax = B by partial gaussian method.
Parameters
----------
matrix: AB
Returns
-------
a: matrix from equations
b: constant vector
@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import json
np.set_printoptions(precision=7)

def partialGaussianMethod(matrix):
    dic = {}
    auxiliary_matrix = np.array(matrix)
    dic[0] = np.array(matrix)
    for i in range(matrix.shape[0]-1):
        # pivot_number is the number in position [i][i] from the matrix
        pivot_number = auxiliary_matrix[0][0]
        pivot_column = np.abs(auxiliary_matrix.T[0])
        posmax_pivot = np.where(pivot_column == np.max(pivot_column))[0][0]
        if(posmax_pivot != 0):
            # changes columns from submatrix
            pivot_number = auxiliary_matrix[posmax_pivot][0]
            temporal_matrix = np.array(auxiliary_matrix[0])
            auxiliary_matrix[0] = np.array(auxiliary_matrix[posmax_pivot])
            auxiliary_matrix[posmax_pivot] = temporal_matrix
            # changes columns from original matrix
            temporal_matrix = np.array(matrix[i])
            matrix[i]=np.array(matrix[i+posmax_pivot])
            matrix[i+posmax_pivot] = temporal_matrix
        if (pivot_number==0 and i == matrix.shape[0]-2):
            dic = {}
            dic[0]="Error: The last pivot number is cero so the matrix doesn't have a solution"
            print(json.dumps(dic))
            exit(1)
        fj = auxiliary_matrix[0] # Fj
        # columvector is the column from the pivot number
        column_vector = np.reshape(auxiliary_matrix.T[0][1:], (auxiliary_matrix.T[0][1:].shape[0], 1))
        # lambda  = columvector/pivot_number
        multiplier = column_vector/pivot_number  # lambda
        fi = auxiliary_matrix[1:]               # fi
        #fi = fi - lambda * fj
        fi = fi - (multiplier*fj)
        #show matrix
        if(i == 0):
            matrix[i+1:] = fi
        else:
            axiliary_fi = fi
            while (axiliary_fi.shape[1]+1 <matrix[i+1:].shape[1]):
                axiliary_fi =  np.insert(axiliary_fi, 0, np.zeros(1), axis=1)
            matrix[i+1:] = np.insert(axiliary_fi, 0, np.zeros(1), axis=1)
        #shorten the matrix to avoid inefficient operations with 0
        auxiliary_matrix = fi.T[1:].T
        dic[i+1] = np.array(matrix)
    a = np.delete(matrix, matrix.shape[1]-1, axis=1)
    b = matrix.T[matrix.shape[1]-1]
    return a,b,dic
