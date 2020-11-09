"""
Created on Tue Oct  6
This program found the solution of matrix Ax = B by simple gaussian method.
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
np.set_printoptions(precision=7)

def luSimpleMethod(matrix):
    dic_step = {}
    dic_l = {}
    dic_u = {}
    auxiliary_matrix = np.array(matrix)
    dic_step[0] = np.array(matrix[:-1])
    top_triangular_matrix = np.zeros((auxiliary_matrix.shape[0],auxiliary_matrix.shape[0]))
    boton_triangular_matrix = np.identity(auxiliary_matrix.shape[0])
    dic_l[0] = np.array(boton_triangular_matrix)
    dic_u[0] = np.array(top_triangular_matrix)

    for i in range(matrix.shape[0]):
        # pivot_number is the number in position [i][i] from the matrix
        pivot_number = auxiliary_matrix[0][0]
        if(pivot_number==0):
            print("the pivot number "+ str(i) +" is cero so the matrix doesn't have a solution")
            break
        if (pivot_number==0 and i ==matrix.shape[0]-2):
            print ("the last pivot number is cero so the matrix doesn't have a solution")

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
            # step and U matrix
            axiliary_fi = fi
            while (axiliary_fi.shape[1]+1 <matrix[i+1:].shape[1]):
                axiliary_fi =  np.insert(axiliary_fi, 0, np.zeros(1), axis=1)
            matrix[i+1:] = np.insert(axiliary_fi, 0, np.zeros(1), axis=1)

        # L matrix
        temporal_l = np.append([1], multiplier.T)
        zeros_l = np.zeros(i)
        temporal_l = np.append(zeros_l,temporal_l)
        if (matrix.shape[0] - 1 != i):
            boton_triangular_matrix.T[i] = temporal_l
        #U matrix
        top_triangular_matrix[i] = matrix[i]

        dic_u[i+1] = np.array(top_triangular_matrix)
        dic_l[i+1] = np.array(boton_triangular_matrix)
        #shorten the matrix to avoid inefficient operations with 0
        auxiliary_matrix = fi.T[1:].T
        dic_step[i+1] = np.array(matrix)
    #a = matrix
    l = boton_triangular_matrix
    u = top_triangular_matrix
    #b = np.array(matrix.T[matrix.shape[1]-1].tolist()[0],dtype=float)
    return l,u,dic_step,dic_l,dic_u

#matrix2 = [[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]
#matrix2 = np.array(matrix2)

"""matrix2 = [[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]
matrix2 = np.array(matrix2)
l,u,dic_step,dic_l,dic_u = luSimpleMethod(matrix2)"""
"""for key in dic_l.keys():
    print(key)
    print("Etapa")
    print(dic_step[key])
    print("L: ")
    print(dic_l[key])
    print("U: ")
    print(dic_u[key])
    print("----------------------------------")"""

#print("Dic"+str(dic_l[]))
#X = np.linalg.inv(A).dot(B)
#print(X)