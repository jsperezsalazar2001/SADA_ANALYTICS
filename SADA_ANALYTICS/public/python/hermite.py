"""
Created on Tue Nov 11
This program finds the interpolation polynomial using the Hermite interpolation method
Parameters
----------
Array XX: array of the x points and the f(x) points
Array Z: array of the f'(x)
size: size of the arrays
Returns
-------
coefficient: Plotter coefficients
plotter: Plotters
@author: Cesar Andres Garcia Posada
"""
import sympy as sm
import math
import sys
import json
import base64
import numpy as np
import matrix_function
import total_gaussian_method
import lagrange
from sympy.parsing.sympy_parser import *


def hermite(xy,z, size):
    results = {}
    size = int(size)
    x = sm.symbols('x')
    xy = xy[1:len(xy)-1]
    index = xy.index("]")
    arrayX = xy[1:index].split(",")
    validate = False
    arrayY = xy[index+3:len(xy)-1].split(",")
    arrayZ = []
    for i in range(len(arrayX)):
        arrayX[i] = float(arrayX[i])
        arrayY[i] = float(arrayY[i])

    for i in range(len(arrayX)):
        if (arrayX.count(arrayX[i]) > 1):
            validate = True
            break

    if validate == True:
        results[0] = "Error There are two equals x points in x array... All of this points have to be differents"
    else:
        z = z[1:len(z)-1]
        z = z.split(",")
        for i in range(len(z)):
            arrayZ.append(float(z[i]))

        dic = lagrange.lagrange(xy,size)
        arrayAux = []
        arrayDerivate = []
        arraySquare = []
        H = []
        H2 = []
        for i in range(len(dic)-1):
            arrayAux.append(parse_expr(dic[i]))
            arraySquare.append(parse_expr(dic[i])*parse_expr(dic[i]))
        for i in range(len(arrayAux)):
            arrayDerivate.append(arrayAux[i].diff(x))
        for i in range(size):
            value = arrayDerivate[i].subs({x:arrayX[i]})
            aux = (((x-arrayX[i])*value*(-2))+1)
            aux = aux * arraySquare[i]
            H.append(aux)
            value = (x-arrayX[i])*arraySquare[i]
            H2.append(value)
        polynomial = 0
        count = 0
        for i in range(len(H)):
            results[count] = str(arrayY[i]*H[i])
            polynomial = polynomial + (arrayY[i]*H[i])
            count = count + 1
        for i in range(len(H2)):
            results[count] = str(arrayZ[i]*H2[i])
            polynomial = polynomial + (arrayZ[i]*H2[i])
            count = count + 1
        results["polynomial"] = str(polynomial)
    data = json.dumps(results)
    print(data)

#hermite("[[1.3,1.6,1.9],[0.6200860,0.4554022,0.2818186]]","[-0.5220232,-0.5698959,-0.5811571]",3)
hermite(sys.argv[1],sys.argv[2],sys.argv[3])