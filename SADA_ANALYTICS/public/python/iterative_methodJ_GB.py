"""
Created on Tue Oct  6
Main method of Jacobi and Gauss Saidel method
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
import jacobi_method
import gauss_seidel
import matrix_function
import json
import sys
np.set_printoptions(precision=7)

def solve_matrix2(a,b,matrix_type,x0,tol,Nmax):
    solution_dic ={}
    a,b,matrix = matrix_function.mix_matrix(a,b)
    d, l, u = matrix_function.extract_D_L_U(a)
    if(matrix_function.determinant(a)):
        if (matrix_type == 'J'):
            dic,dic_result = jacobi_method.jacobiMethod(l,d,u,b,x0,tol,Nmax)
        elif(matrix_type == 'GS'):
            dic,dic_result = gauss_seidel.gauss_seidel(l,d,u,b,x0,tol,Nmax)
        else:
            print("function type doesn't exist")
        # print(dic_resoult)
        # for lop only for print result
        print(dic["T"])
        print(dic["C"])
        print(dic["spectral_radius"])
        for i in dic_result.keys():
            print(dic_result[i])
    else:
        print("function determinant is equals to 0")
        exit(1)

x = solve_matrix2("[[200,-1,-14],[1,8,-3],[1,0,5]]","[0,1,1]",'J',[0,0,0],0.0000001,100)
