"""
Created on Tue Nov  10 

This program finds the interpolating polynomial of the given data 
using the Vandermonde method.

Parameters
----------
X : Abscissa
Y : Ordered

Returns
-------
Coef : Coefficients of the polynomial

@author: Juan Sebastián Pérez Salazar
"""

import numpy as np
import matrix_function as mf

def vandermonde(X, Y):
    dic = {}
    
    n = len(X)
    A = np.zeros((n,n))
    
    for i in range(n):
        for j in range(n):
            A[j][i] = X[j]**(n-(i+1))
    
    coef = np.array(mf.soltion(A, Y.T))
    print(A)
    print(coef)

X = np.array([-1, 0, 3, 4])
Y = np.array([15.5, 3, 8, 1])

vandermonde(X, Y)
