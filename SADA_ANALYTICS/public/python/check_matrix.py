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
import simple_gaussian_method
import partial_gaussian_method
import total_gaussian_method
import json
import sys
np.set_printoptions(precision=7)


def determinant(matrix):
    if(np.linalg.det(matrix)!=0):
        return True
    else:
        return False


def mix_matrix(a,b):
    try:
        split_a = a.split('],[')
        vector = b.replace('[', '').replace(']', '').split(',')
        final_vector = []
        matrix_values = ""
        try:
            for row in range(len(split_a)):
                if (row == 0):
                    split_a[row] = split_a[row][2:] + ';'
                elif (row == len(split_a) - 1):
                    split_a[row] = split_a[row][:-2]
                else:
                    split_a[row] = split_a[row] + ';'
                matrix_values = matrix_values + str(split_a[row])
                final_vector.append(vector[row])
            a = np.matrix(matrix_values, dtype=float)
            b = np.matrix(vector, dtype=float)
            matrix = np.insert(a, a.shape[1], b, axis=1)
            return a, b, matrix
        except:
            print("Be careful about dimensions from matrix and the vector")
    except:
        print("Doesn't possible transform matrix to numeric matrix take a look in the matrix's values")
        exit(1)


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


def sort(x,movement):
    movement = movement.astype(int)
    for i in range(len(movement)-1,0,-2):
        temporal_value = x[movement[i]]
        x[movement[i]] = x[movement[i-1]]
        x[movement[i-1]] = temporal_value
    return x


def rebuild_matrix(dic):
    final_row = np.array([],dtype=str)
    final_value = np.array([],dtype=str)
    for key in dic:
        matrix = dic[key]
        for row in matrix:
            for result in row.tolist():
                final_value = np.append(final_value, '{:.7f}'.format(result))
            final_row = np.append(final_row, str(final_value))
            final_value = np.array([], dtype=str)
        dic[key] = final_row.tolist()
        final_row = np.array([])
    return dic


def solve_matrix(a,b,matrix_type):
    solution_dic ={}
    a,b,matrix = mix_matrix(a,b)
    if(determinant(a)):
        if(matrix_type == 'S'):
            a,b,dic = simple_gaussian_method.simpleGaussianMethod(matrix)
        elif(matrix_type == 'P'):
            a,b,dic = partial_gaussian_method.partialGaussianMethod(matrix)
        elif(matrix_type == 'T'):
            a,b,dic,movement = total_gaussian_method.totalGaussianMethod(matrix)
        else:
            print("function type doesn't exist")
        x = soltion(a,b)
        dic = rebuild_matrix(dic)
        if(matrix_type == 'T'):
            x = sort(x,movement)
        dic["x"] = x.tolist()
        solution_dic["dic"] = dic
        solution_dic["x"] = x
        print (json.dumps(dic))
    else:
        print("function type doesn't exist")
        exit(1)

#x = solve_matrix("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]",'S')
solve_matrix(sys.argv[1],sys.argv[2],str(sys.argv[3]))
#x = solve_matrix("[[-1,7,7,4],[1.1,-7.6999,-1,1],[5,-3,0,6],[-12,1,9,0]]","[2.5,3.7,2.2,-32]",'P')