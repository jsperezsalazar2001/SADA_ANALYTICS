"""
Created on Tue Oct  6
This program found the solution of matrix Ax = B by total gaussian method.
Parameters
----------
matrix: AB
Returns
-------
a: matrix from equations
b: constant vector
movement : vector with x's positions

@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
np.set_printoptions(precision=7)

def totalGaussianMethod(matrix):
    dic ={}
    movement = np.array([])
    auxiliary_matrix = np.array(matrix)
    dic[0] = np.array(matrix)
    for i in range(matrix.shape[0]-1):
        sub_matrix = np.delete(auxiliary_matrix, auxiliary_matrix.shape[1]-1, axis=1)
        # pivot_number is the number in position [i][i] from the matrix
        pivot_number = sub_matrix[0][0]
        pos_max_pivot = 0
        row = 0
        for j in range(sub_matrix.shape[0]):
            pivot_column = np.abs(sub_matrix[j])
            temporal_maxpivot = np.max(pivot_column)
            temporal_pos_max_pivot = np.where(pivot_column == np.max(pivot_column))[0][0]
            if(pivot_number<temporal_maxpivot):
                pivot_number = temporal_maxpivot
                pos_max_pivot = temporal_pos_max_pivot
                row = j
        if(row != 0):
            # changes the columns from sub_matrix
            pivot_number = auxiliary_matrix[row][pos_max_pivot]
            temporal_matrix = np.array(auxiliary_matrix[0])
            auxiliary_matrix[0] = np.array(auxiliary_matrix[row])
            auxiliary_matrix[row] = temporal_matrix
            # changes the columns from original matrix
            temporal_matrix = np.array(matrix[i])
            matrix[i]=np.array(matrix[i+row])
            matrix[i+row] = temporal_matrix
        if (pos_max_pivot!=0):
            # changes columns from sub_matrix
            transpose_matrix = np.array(auxiliary_matrix.T)
            temporal_matrix = np.array(transpose_matrix[0])
            transpose_matrix[0] = np.array(transpose_matrix[pos_max_pivot])
            transpose_matrix[pos_max_pivot] = temporal_matrix
            auxiliary_matrix = np.array(transpose_matrix.T)
            # changes columns from original matrix
            transpose_matrix = np.array(matrix.T)
            temporal_matrix = np.array(transpose_matrix[i])
            transpose_matrix[i] = np.array(transpose_matrix[pos_max_pivot+i])
            transpose_matrix[pos_max_pivot+i] = temporal_matrix
            matrix = np.array(transpose_matrix.T)
            movement = np.concatenate((movement, [i,pos_max_pivot+i]))
        if (pivot_number==0 and i == matrix.shape[0]-2):
            print ("the last pivot number is cero so the matrix doesn't have a solution")
        fj = auxiliary_matrix[0] # Fj
        # colum_vector is the column from the pivot number
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
    A = np.delete(matrix, matrix.shape[1]-1, axis=1)
    B = matrix.T[matrix.shape[1]-1]
    return A,B,dic,movement
