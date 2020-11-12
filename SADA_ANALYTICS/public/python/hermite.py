"""
Created on Tue Nov 11
This program finds the interpolation polynomial using the Hermite interpolation method
Parameters
----------
Array X: array of the x points
Array Y: array of the f(x)
Array Z: array of the f'(x)
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


def hermite(x,y,z):
    xValor = sm.symbols('x')
    sizeX = len(x)
    sizeY = len(y)
    sizeZ = len(z)
    if sizeX != sizeY:
        print("Error")
    elif sizeX != sizeZ:
        print("Error")
    else:
        counterColumn = 0
        x = np.array(x)
        y = np.array(y)
        n = sizeX*3
        D = np.zeros((sizeX*2,n))
        k = []
        for i in range(sizeX*2):
            k.append(i)
        k = np.array(k)
        D[:,counterColumn] = k.T
        counterColumn = counterColumn + 1
        zk = []
        fzk = []
        for i in range(sizeX):
            zk.append(x[i])
            zk.append(x[i])
            fzk.append(y[i])
            fzk.append(y[i])
        zk = np.array(zk)
        D[:,counterColumn] = zk.T  
        counterColumn = counterColumn + 1
        fzk = np.array(fzk)
        D[:,counterColumn] = fzk.T
        counterColumn = counterColumn + 1
        fdzk = []
        counter = 0
        counterAux = 0
        index = 0
        while counter < len(k):
            if counter == 0:
                fdzk.append(0)
            elif counter == 1:
                fdzk.append(z[0])
                counterAux = counterAux+1
            elif counter%3==0 and counter != 0:
                fdzk.append(z[counterAux])
                counterAux = counterAux+1
            else:
                if index == 0:
                    index = counter
                num = D[counter][2]-D[counter-1][2]
                den = D[counter][1]-D[counter-1][1]
                fdzk.append(num/den)
            counter = counter + 1
        fdzk = np.array(fdzk)
        D[:,counterColumn] = fdzk.T
        counterColumn = counterColumn + 1

        for i in range(index,len(k)):
            

        print(D)

hermite([-2,1],[-12,9],[22,10])