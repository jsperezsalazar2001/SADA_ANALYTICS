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
    x0 = matrix_function.fromStringToFloatVector(x0)
    try:
        tol = float(tol)
        Nmax = float(Nmax)
    except:
        print("Be careful with values of tolerance or iterations number")
        exit(1)
    if(matrix_function.determinant(a)):
        if (matrix_type == 'J'):
            dic,dic_result,C_aux,spectral_radius = jacobi_method.jacobiMethod(l,d,u,b,x0,tol,Nmax)
            dic = matrix_function.rebuild_matrix(dic)
            dic["C"] = C_aux
            dic["spectral_radius"] = spectral_radius
        elif(matrix_type == 'GS'):
            dic,dic_result = gauss_seidel.gauss_seidel(l,d,u,b,x0,tol,Nmax)
        else:
            print("function type doesn't exist")
        
        print(json.dumps(dic))
        print(json.dumps(dic_result))
        
    else:
        print("function determinant is equals to 0")
        exit(1)

solve_matrix2(sys.argv[1],sys.argv[2],str(sys.argv[3]),sys.argv[4],sys.argv[5],sys.argv[6])
#x = solve_matrix2("[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]","[1,1,1,1]",'J',"[0,0,0,0]","0.0000001","100")
