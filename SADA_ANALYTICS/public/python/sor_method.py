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
import matrix_function
import json

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
    """if spectral_radius > 1:
                    print('Jacobi method doesn´t work becuase its spectral radius is greater than 1')
                    exit(1)"""

    C_aux = C.T[0]
    dic["T"] = T
    dic_resoult[cont] = [0, '', str(matrix_function.rebuild_vector(x0))[1:-1].replace("'","").split()]
    
    while E>tol and cont<Nmax:
        xact = np.dot(T,xant) + C
        E =  np.linalg.norm(xant - xact)
        xant = xact
        cont = cont + 1

        qwe = np.array(xant.T)
        aux = str(matrix_function.rebuild_vector(np.array(xant.T)[0]))[1:-1].replace("'","").split()
        dic_resoult[cont] = [cont,E,aux]

    C_aux = str(matrix_function.rebuild_vector(np.array(C_aux)[0]))[1:-1].replace("'","").split()
    spectral_radius = matrix_function.rebuild_constant(spectral_radius)
    
    return dic, dic_resoult,C_aux,spectral_radius