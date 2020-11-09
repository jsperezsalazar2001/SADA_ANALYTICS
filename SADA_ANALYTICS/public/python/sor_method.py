"""
Created on Sun Nov 8
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

def sorMethod(l,d,u,b,x0,tol,Nmax,w):
    dic = {}
    dic_resoult = {}
    x0 = np.array(x0)
    T = np.dot(np.linalg.inv(d-np.dot(w,l)),(np.dot((1-w),d))+np.dot(w,u))
    C = np.dot((np.linalg.inv(d-(w*l))*w),b.T)
    E = float("inf")
    xant = np.reshape(x0,(x0.shape[0],1))
    cont = 0

    values, normalized_eigenvectors = np.linalg.eig(T)
    spectral_radius = max(abs(values))
    if spectral_radius > 1:
        print('Jacobi method doesn´t work becuase its spectral radius is greater than 1')
        exit(1)

    C_aux = C.T[0]
    dic["T"] = T
    dic["C"] = C_aux
    dic["spectral_radius"] = spectral_radius
    dic_resoult[cont] = [0, '', x0]

    while E>tol and cont<Nmax:
        xact = np.dot(T,xant) + C
        E =  np.linalg.norm(xant - xact)
        xant = xact
        cont = cont + 1
        dfg = np.append(cont,E)
        dfg = np.append(dfg,xant.T[0])
        dic_resoult[cont] = [cont, E, xant.T[0]]

    return dic, dic_resoult