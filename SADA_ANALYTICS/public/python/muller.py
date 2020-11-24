"""
Created on Mon Oct  5 
This program found the solution of ecuation f(x) = 0 using three initial approximations. 
If the user wishes, he can enter only 2 approximations, the third is calculated through the midpoint

Parameters
----------
function : Continue function
x_0 : first approximation
x_1 : second approximation
x_2 : third approximation
delta: change on x
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

def muller(x_0, x_1, x_2, tolerance, function, iterations):
    x_0 = float(x_0)
    x_1 = float(x_1)
    x_2 = float(x_2)
    tolerance = float(tolerance)
    iterations = int(iterations)
    results = {}
    if x_0 == x_1:
        results[0] = "Error x0 Has to be different from x1"
    elif tolerance <= 0:
        results[0] = "Error the tolerance has to be positive and greater than 0" 
    elif iterations <= 0:
        results[0] = "Error the iterations has to be positive and greater than 0"
    else:
        x = sm.symbols('x')
        if (sm.sympify(function).subs(x,x_0) > 0 and sm.sympify(function).subs(x,x_1) < 0) or (sm.sympify(function).subs(x,x_0) < 0 and sm.sympify(function).subs(x,x_1) > 0):
            count = 0
            error = abs(x_1-x_2)
            try: 
                while (error > tolerance) and (count < iterations):
                    h_0 = x_1 - x_0
                    h_1 = x_2 - x_1
                    f_x0 = sm.sympify(function).subs(x,x_0)
                    f_x1 = sm.sympify(function).subs(x,x_1)
                    f_x2 = sm.sympify(function).subs(x,x_2)
                    delta_0 = (f_x1-f_x0)/h_0
                    delta_1 = (f_x2-f_x1)/h_1
                    a = (delta_1-delta_0)/(h_1-h_0)
                    b = (a*h_1)+delta_1
                    c = f_x2
                    try:
                        raiz = math.sqrt((b**2)-(4*a*c))
                        if b<0:
                            denominador = b-raiz
                        else:
                            denominador = b+raiz
                        x_3 = x_2 + ((-2*c)/denominador)
                        x_0 = x_1
                        x_1 = x_2
                        x_2 = x_3
                        error = abs(x_1-x_2)
                        results[count] = [count,round(float(x_2),7),round(float(f_x2),7),round(float(error),7)]
                        count = count + 1
                    except:
                        results[0] = "Error with initial data, try with different approximations"
            except:
                results[0] = "Error Divide by 0"
        else:
            results[0] = "Error with initial data, There isn't a root in the initial x" 
    aux = json.dumps(results)
    print(aux)

muller(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6])