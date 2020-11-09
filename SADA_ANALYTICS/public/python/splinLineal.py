import sympy as sm
import math
import sys
import json
import base64
import numpy as np
import check_matrix
import total_gaussian_method


def splineLineal(x,y):
    xValor = sm.symbols('x')
    sizeX = len(x)
    sizeY = len(y)
    if sizeX != sizeY:
        print("Error")
    else:
        m = 2*(sizeX-1)
        A = np.eye(m)
        for i in range(0,m):
            A[i][i] = 0
        contador = 0
        contadorFilas = 0
        b = []
        for i in range(0,sizeX):
            vec_x = x[i]
            A[i][contador] = vec_x
            A[i][contador+1] = 1
            contador = contador + 2
            if i == 0:
                contador = 0
            b.append(y[i])
            contadorFilas = contadorFilas + 1
        contador = 0
        for i in range(1,len(x)-1):
            A[contadorFilas][contador] = x[i]
            A[contadorFilas][contador+1] = 1
            A[contadorFilas][contador+2] = -(x[i])
            A[contadorFilas][contador+3] = -1
            contador = contador + 2
            contadorFilas = contadorFilas + 1
            b.append(0)
        arreglo = []
        for i in range(0,m):
            arreglo2 = []
            for j in range(0,m):
                arreglo2.append(A[i][j])
            arreglo.append(arreglo2)
        A = str(arreglo).replace(" ","")
        b = str(b)
        a,b,matrix = check_matrix.mix_matrix(A,b)
        a,b,dic,movement = total_gaussian_method.totalGaussianMethod(matrix)
        x = check_matrix.soltion(a,b)
        x = check_matrix.sort(x,movement)
        aux = []
        for i in range(0,len(x)):
            aux.append(x[i])
        coeficiente = []
        contador = 0
        while contador < len(aux)-1:
            i = []
            i.append(aux[contador])
            i.append(aux[contador+1])
            contador = contador + 2
            coeficiente.append(i)
        print("Coeficientes de los trazadores: ")
        print(coeficiente)
        print("Trazadores: ")
        trazadores = []
        for i in range(len(coeficiente)):
            print((float(coeficiente[i][0])*xValor)+float(coeficiente[i][1]))




            
splineLineal([-1,0,3,4],[15.5,3,8,1])