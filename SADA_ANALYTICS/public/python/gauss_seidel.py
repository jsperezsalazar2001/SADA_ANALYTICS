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
np.set_printoptions(precision=7)

def gauss_seidel(l,d,u,b,x0,tol,Nmax):
    dic = {}
    dic_result= {}
    x0 = np.array(x0)
    T = np.dot(np.linalg.inv(d - l),u)
    C = np.dot(np.linalg.inv(d - l),b.T)
    E = float("inf")
    xant = np.reshape(x0,(x0.shape[0],1))
    cont = 0

    values, normalized_eigenvectors = np.linalg.eig(T)
    spectral_radius = max(abs(values))
    if spectral_radius > 1:
        print('Gauss-seidel method doesn´t work becuase its spectral radius is greater than 1')
        exit(1)

    C_aux = C.T[0]
    dic["T"] = T
    dic["C"] = C_aux
    dic["spectral_radius"] = spectral_radius
    dic_result[cont] = [0, '', x0]

    while E>tol and cont<Nmax:
        xact = np.dot(T,xant) + C
        E =  np.linalg.norm(xant - xact)
        xant = xact
        cont = cont + 1
        dic_result[cont] = [cont,E,xant.T[0]]

    return dic,dic_result

