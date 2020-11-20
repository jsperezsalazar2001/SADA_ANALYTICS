"""
Created on Tue Nov 11
This program finds the interpolation polynomial using the linear splin method
Parameters
----------
Array X: array of the x points
Array Y: array of the f(x)
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


def linealSpline(data, n):
    data = data.replace('[', '').replace(']', '').split(',')
    x = []
    y = []
    for i in range(0,len(data)):
        if i < int(n):
            x.append(float(data[i]))
        else:
            y.append(float(data[i]))
    xValor = sm.symbols('x')
    sizeX = len(x)
    sizeY = len(y)
    results = {}
    if sizeX != sizeY:
        results[0] = "Error the size of the x vector is different to y vector"
    else:
        m = 2*(sizeX-1)
        A = np.eye(m)
        for i in range(0,m):
            A[i][i] = 0
        counter = 0
        counterRows = 0
        b = []
        for i in range(0,sizeX):
            vec_x = x[i]
            A[i][counter] = vec_x
            A[i][counter+1] = 1
            counter = counter + 2

            if i == 0:
                counter = 0
            b.append(y[i])
            counterRows = counterRows + 1
        counter = 0
        for i in range(1,len(x)-1):
            A[counterRows][counter] = x[i]
            A[counterRows][counter+1] = 1
            A[counterRows][counter+2] = -(x[i])
            A[counterRows][counter+3] = -1
            counter = counter + 2
            counterRows = counterRows + 1
            b.append(0)
        array = []
        for i in range(0,m):
            array2 = []
            for j in range(0,m):
                array2.append(A[i][j])
            array.append(array2)
        A = str(array).replace(" ","")
        b = str(b)
        a,b,matrix = matrix_function.mix_matrix(A,b)
        a,b,dic,movement = total_gaussian_method.totalGaussianMethod(matrix)
        x = matrix_function.soltion(a,b)
        x = matrix_function.sort(x,movement)
        aux = []
        for i in range(0,len(x)):
            aux.append(x[i])
        coefficient = []
        counter = 0
        counterAux = 0
        while counter < len(aux)-1:
            i = []
            i.append(aux[counter])
            i.append(aux[counter+1])
            counter = counter + 2
            results[counterAux] = i
            counterAux = counterAux + 1
            coefficient.append(i)
        plotter = []
        for i in range(len(coefficient)):
            plotter.append(str((float(coefficient[i][0])*xValor)+float(coefficient[i][1])))
        results["plotter"] = plotter
        data = json.dumps(results)
        print(data)
          
#linealSplin([-1,0,3,4],[15.5,3,8,1])
linealSpline(sys.argv[1],sys.argv[2])