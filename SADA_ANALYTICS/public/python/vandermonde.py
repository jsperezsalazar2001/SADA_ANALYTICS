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
import sys
import json

def vandermonde(X, Y):
    dic = {}
    X = X.replace('[', '').replace(']', '').split(',')
    Y = Y.replace('[', '').replace(']', '').split(',')
    X = np.array(X, dtype=float)
    Y = np.array(Y, dtype=float)
    
    validate = False
    unique_elements, counts_elements = np.unique(X, return_counts=True)
    
    for i in counts_elements:
        if(i>1):
            validate=True
            break
    if (validate):
        dic[0]="Error: there are equal points in the vector X"
    else:
        n = len(X)
        A = np.zeros((n,n))
        
        for i in range(n):
            for j in range(n):
                A[j][i] = X[j]**(n-(i+1))
        
        coef = np.array(mf.soltion(A, Y.T))
        dic["v_matrix"] = np.array(A)
        dic = mf.rebuild_matrix(dic)
        dic["coef"] = str(coef)
        
        polynomial = ""
        for i in range(len(coef)):
            if coef[i][0] != '-' and i != 0:
                polynomial += "+"
            polynomial += coef[i]
            if(i != len(coef)-1):
                polynomial += "x^"+str((len(coef)-(i+1)))
        dic["polynomial"] = polynomial
    print(json.dumps(dic))

X = "[-1,0,3,4]"
Y = "[15.5,3,8,1]"

#vandermonde(X, Y)
vandermonde(sys.argv[1],sys.argv[2])
