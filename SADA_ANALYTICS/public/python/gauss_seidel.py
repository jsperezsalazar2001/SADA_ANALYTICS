"""
Created on Tue Nov  10 
This program finds the solution to the system Ax = b using Gauss-seidel method.

Parameters
----------
A : Invertible matrix
b : Constant vector
x0 : Initial aproximation
tol : Tolerance
n_max : Maximum number of iterations

Returns
-------
iter: Iterations number
x : Solution
E : error

@author: Juan Sebastián Pérez Salazar
"""

import numpy as np
import matrix_function
import json
np.set_printoptions(precision=7)

def gauss_seidel(l,d,u,b,x0,tol,Nmax):
    dic = {}
    dic_result= {}
    try:
        x0 = np.array(x0)
        T = np.dot(np.linalg.inv(d - l),u)
        C = np.array(np.dot(np.linalg.inv(d - l),b.T))
        #C = np.reshape(np.diag(np.multiply(np.linalg.inv(d - l),b)),(b.shape[1],1))
        E = float("inf")
        xant = np.reshape(x0,(x0.shape[0],1))
        cont = 0

        values, normalized_eigenvectors = np.linalg.eig(T)
        spectral_radius = max(abs(values))
        if spectral_radius > 1:
            dic = {}
            dic[0]="Error: Gauss-seidel method does not work becuase its spectral radius is greater than 1"
            print(json.dumps(dic))
            exit(1)

        C_aux = C.T[0]
        dic["T"] = T
        #dic["C"] = C_aux
        #dic["spectral_radius"] = spectral_radius
        dic_result[cont] = [0, '', str(matrix_function.rebuild_vector(x0))[1:-1].replace("'","").split()]

        while E>tol and cont<Nmax:
            xact = np.dot(T,xant) + C
            E =  np.linalg.norm(xant - xact)
            xant = xact
            cont = cont + 1
            aux = str(matrix_function.rebuild_vector(xant.T[0]))[1:-1].replace("'","").split()
            dic_result[cont] = [cont,round(float(E),7),aux]

        C_aux = str(matrix_function.rebuild_vector(C_aux))[1:-1].replace("'","").split()
        spectral_radius = matrix_function.rebuild_constant(spectral_radius)
    except BaseException as e:
        if("Error" in str(e)):
            dic[0]=str(e)
        else:
            dic[0] = "Error " + str(e)
        print(json.dumps(dic))
        exit(1)
    return dic,dic_result,C_aux,spectral_radius

