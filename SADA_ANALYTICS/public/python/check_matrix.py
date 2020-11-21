"""
Created on Tue Oct  6
Parameters
Main method of Simple,Partial,Total gaussian methods and LU simple method
----------
matrix: AB
Returns
-------
@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import simple_gaussian_method
import partial_gaussian_method
import total_gaussian_method
import lu_simple_method
import partial_lu
import matrix_function
import json
import sys
np.set_printoptions(precision=7)

def solve_matrix(a,b,matrix_type):
    solution_dic ={}
    a,b,matrix = matrix_function.mix_matrix(a,b)
    if(matrix_function.determinant(a)):
        if(matrix_type == 'S'):
            a,b,dic = simple_gaussian_method.simpleGaussianMethod(matrix)
        elif(matrix_type == 'P'):
            a,b,dic = partial_gaussian_method.partialGaussianMethod(matrix)
        elif(matrix_type == 'T'):
            a,b,dic,movement = total_gaussian_method.totalGaussianMethod(matrix)
        elif (matrix_type == 'LUS'): #LU_simple
            l,u,dic,dic_l,dic_u = lu_simple_method.luSimpleMethod(a)
        elif(matrix_type == 'LUP'): #partial_lu
            l,u,pb,dic,dic_l,dic_u,dic_p = partial_lu.partial_lu(a, b)
        else:
            print("function type doesn't exist")

        if(matrix_type == 'LUP'):
            z = np.array(matrix_function.soltion(l,pb),float)
            x = matrix_function.soltion(u,z)
            dic_l = matrix_function.rebuild_matrix(dic_l)
            dic_u = matrix_function.rebuild_matrix(dic_u)
            dic_p = matrix_function.rebuild_matrix(dic_p)
        elif(matrix_type == 'LUS'):
            z = np.array(matrix_function.soltion(l,b),float)
            x = matrix_function.soltion(u,z)
            dic_l = matrix_function.rebuild_matrix(dic_l)
            dic_u = matrix_function.rebuild_matrix(dic_u)
            #dic["dic_l"] = dic_l
            #dic["dic_u"] = dic_u
        else:
            x = matrix_function.soltion(a,b)
            
        dic = matrix_function.rebuild_matrix(dic)

        if(matrix_type == 'T'):
            x = matrix_function.sort(x,movement)
        dic["x"] = x.tolist()
        solution_dic["dic"] = dic
        solution_dic["x"] = x

        print (json.dumps(dic))
        if(matrix_type == 'LUS'):
            print(json.dumps(dic_l))
            print(json.dumps(dic_u))
        elif(matrix_type == 'LUP'):
            print(json.dumps(dic_l))
            print(json.dumps(dic_u))
            print(json.dumps(dic_p))
    else:
        print("function determinant is equals to 0")
        exit(1)

A = "[[4, -1, 0, 3], [1,15.5,3,8], [0,-1.3,-4,1.1], [14,5,-2,30]]"
b = "[1,1,1,1]"
#x = solve_matrix("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]",'S')
#solve_matrix(sys.argv[1],sys.argv[2],str(sys.argv[3])) # this line has to moment if you want run lu simple method
#solve_matrix(A, b, 'LUS')
#x = solve_matrix("[[-1,7,7,4],[1.1,-7.6999,-1,1],[5,-3,0,6],[-12,1,9,0]]","[2.5,3.7,2.2,-32]",'P')

#x = solve_matrix("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]",'S')
#x = solve_matrix("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]",'P')
#x = solve_matrix("[[2,-1,0,3],[1,0.5,3,8],[0,13,-2,11],[14,5,-2,3]]","[1,1,1,1]",'T')
x = solve_matrix("[[4,-1,0,3],[1,15.5,3,8],[0,-1.3,-4,1.1],[14,5,-2,30]]","[1,1,1,1]",'LUP')