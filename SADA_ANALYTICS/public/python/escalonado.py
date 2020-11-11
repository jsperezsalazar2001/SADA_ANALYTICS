"""
Created on Tue Nov 11
This program found the solution of matrix Ax = B by Stepped Partial Pivot.
Parameters
----------
matrix: AB
Returns
-------
a: matrix from equations
b: constant vector
dic: dictionary to pass the data to the view

@author: Cesar Andres Garcia Posada
"""
import numpy as np
import matrix_function

np.set_printoptions(precision=7)

def escalonadoMethod(matrix):
    dic = {}
    auxiliary_matrix = np.array(matrix)
    dic[0] = np.array(matrix)
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
        dic[i+1] = np.array(matrix)
        print("Step "+ str(i))
        print(matrix)
    a = np.delete(matrix, matrix.shape[1]-1, axis=1)
    b = matrix.T[matrix.shape[1]-1]
    return a,b,dic

matrix2 = [[2.11,-4.21,0.921,2.01],[4.01,10.2,-1.12,-3.09],[1.09,0.987,0.831,4.21]]
matrix2 = np.array(matrix2)
A,B,dic = escalonadoMethod(matrix2)
x = matrix_function.soltion(A,B)
print(x)