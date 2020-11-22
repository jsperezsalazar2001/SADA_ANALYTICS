"""
Created on Wednesday Nov 11
Parameters
----------
d: vector with values for principal diagonal from matrix a
l: vector with values for lower triangular from matrix a
u: vector with values for upper triangular from matrix a
b: constant vector
x0: Initial vector aproximation
tol: Tolerance
Nmax: Maximum number of iterations
w: weighting factor
Returns
-------
dic: step dictionary (float with decimals)
dic_resoult: step dictionary from table solution (float with decimals)
@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import sor_method
import matrix_function
import json
import sys
np.set_printoptions(precision=7)

def solve_matrix3(a,b,matrix_type,x0,tol,Nmax,w):
    solution_dic ={}
    a,b,matrix = matrix_function.mix_matrix(a,b)
    x0 = matrix_function.fromStringToFloatVector(x0)
    try:
        tol = float(tol)
        Nmax = float(Nmax)
        w = float(w)
    except:
        print("Be careful with values of tolerance, iterations number or W values")
        exit(1)
    if(matrix_function.determinant(a)):
        if (matrix_type == 'SOR'):
            d,l,u = matrix_function.extract_D_L_U(a)
            dic,dic_result,C_aux,spectral_radius = sor_method.sorMethod(l,d,u,b,x0,tol,Nmax,w)
            dic = matrix_function.rebuild_matrix(dic)
            dic["C"] = C_aux
            dic["spectral_radius"] = spectral_radius
        else:
            print("function type doesn't exist")
        
        print(json.dumps(dic))
        print(json.dumps(dic_result))
    else:
        print("function determinant is equals to 0")
        exit(1)

solve_matrix3(sys.argv[1],sys.argv[2],str(sys.argv[3]),sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7])
#x = solve_matrix3("[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]","[1,1,1,1]",'SOR',[0,0,0,0],0.0000001,100,1.5)