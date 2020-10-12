"""
Created on Mon Oct  5 
This program finds the solution to the equation f (x) = 0, by means of an acceleration of the 
bisection method (aitken method)
This is why we have the bisection method and in each iteration, we will only take 3 
iterations of the bisection method


Parameters bisection method
----------
function : Continue function
a : Right limit of initial interval
b : Left limit of initial interval

Returns
-------
results : array with data from each iteration

Parameters aitken method
----------
function : Continue function
x_0 : Right limit of initial interval
x_1 : Left limit of initial interval
iterations : Maximum number of iterations
tolerance: Rolerance for method control

Returns
-------
results : array with data from each iteration


@author: César Andrés García Posada
"""

import sympy as sm
import math
import sys
import json
import base64

def bisection(function, a, b):
    a = float(a)
    b = float(b)
    
    results = []
    x_in = sm.symbols('x')
    f_a = sm.sympify(function).subs(x_in, a)
    f_b = sm.sympify(function).subs(x_in, b)
    
    if f_a * f_b >= 0:
        return 0
    else:
        mp = (a + b)/2
        f_mp = sm.sympify(function).subs(x_in, mp)
        results.append([a,mp,b])
        cont = 1
        while cont <= 2:
            if f_a * f_mp < 0:
                b = mp
            else:
                a = mp
            p_0 = mp
            mp = (a + b)/2
            f_mp = sm.sympify(function).subs(x_in, mp)
            cont = cont + 1
            results.append([a,mp,b])
        return results

def aitken(x_0, x_1, tolerance, function, iterations):
    results = {}
    x_0 = float(x_0)
    x_1 = float(x_1)
    tolerance = float(tolerance)
    iterations = int(iterations)
    bisectionResult = bisection(function,x_0,x_1)
    infinite = float("inf")
    if bisectionResult != 0:
        x = sm.symbols('x')
        count = 1 
        error = infinite
        xAitken0 = 0
        while count <= iterations and error > tolerance and error != 0 and bisectionResult != 0:
            x1 = bisectionResult[0][1]
            x2 = bisectionResult[1][1]
            x3 = bisectionResult[2][1]
            xAitken = (x1*x3-(x2**2))/(x3-2*x2+x1)
            f_xAitken = sm.sympify(function).subs(x, xAitken)
            error = abs(xAitken0-xAitken)
            if error == 0:
                error = infinite
            xAitken0 = xAitken
            results[count] = [int(count),float(xAitken),float(f_xAitken),float(error)]
            x_0 = bisectionResult[1][0]
            x_1 = bisectionResult[1][2]
            bisectionResult = bisection(function,x_0,x_1)
            count = count + 1
    else:
        results[0] = "Error en el calculo del metodo"

    for key in results:
        if results[key][3] == infinite:
            results[key][3] = 0
    aux = json.dumps(results)
    print(aux)

#aitken(0,1,0.0000001,"(x^2)-x+1.25-(exp(x))",100)
aitken(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])