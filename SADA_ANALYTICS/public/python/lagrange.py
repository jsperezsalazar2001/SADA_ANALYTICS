"""
Created on Tue Nov  10 
This program finds the polynomial to interpolation of x array and y array with Lagrange method

Parameters
----------
A : Invertible matrix
b : Constant vector

Returns
-------
x : Solution
L : Factorization matrix L
U : Factorization matriz U


@author: Cesar Andres Garcia Posada
"""

import sympy as sm
import math
import sys
import json
import base64

def lagrange(data, n):
    data = data.replace('[', '').replace(']', '').split(',')
    Arrx = []
    Arry = []
    for i in range(0,len(data)):
        if i < int(n):
            Arrx.append(float(data[i]))
        else:
            Arry.append(float(data[i]))
    results = {}
    if len(Arrx) != len(Arry):
        results[0] = "Error the size of the x vector is different to y vector"
    else:
        x = sm.symbols('x')
        size = len(Arrx)
        polynomial = []
        arrayL = []
        for i in range(0,size):
            pos = i
            value = Arrx[i]
            numerator = 1 
            denominator = 1
            for j in range(0,size):
                if j != i:
                    numerator = numerator*(x-Arrx[j])
                    denominator = denominator*(value-Arrx[j])
            aux = numerator/denominator
            aux = aux.expand()
            aux = str(aux)
            arrayAux = []
            arrayAux.append(aux)
            results[i] = aux
            coefficient = numerator*Arry[i]/denominator
            coefficient = coefficient.expand()
            polynomial.append(coefficient)
        sumPol = 0
        for i in range(0,len(polynomial)):
            sumPol = sumPol + polynomial[i]
        arrayAux = []
        sumPol = str(sumPol)
        arrayAux.append(sumPol)
        results["polynomial"] = sumPol

    data = json.dumps(results)
    print(data)


#x = [-2,-1,2,3]
#y = [12.13533528,6.367879441,-4.610943901,2.085536923]
#lagrange("[[-1,0,3,4],[15.5,3,8,1]]",4)
#lagrange([-1,0,3,4],[15.5,3,8,1],4)

lagrange(sys.argv[1],sys.argv[2])