
"""
Created on Sat Oct  10 
This program finds the solution to the ecuation f(x) = 0 using the Fixed Point method.

Parameters
----------
f_function : Continuous  function
g_function : G function corresponding to f
initial_x : Initial aproximation
tolerance : Error tolerance
iterations : Maximum number of iterations

Returns
-------
Table of results:
    columns:
    - Iteration
    - xi
    - g(xi)
    - f(xi)
    - Error

@author: Yhoan Alejandro Guzman Garcia
"""
import sympy as sm
import math
import sys
import traceback
import json
import base64
def fixedPoint(f_function, g_function, initial_x, tolerance, iterations):
    results = {}
    try:
        f_function = str(f_function)
        g_function = str(g_function)
        initial_x = float(initial_x)
        tolerance = float(tolerance)
        iterations =int(iterations)
        if tolerance <= 0:
            raise Exception("Tolerance must be positive")
        elif iterations <= 0:
            raise Exception("The number of iterations must be greater than 0")
        else:
            iter_count = 0
            x_in = sm.symbols('x')
            g_x = sm.sympify(g_function).subs(x_in, initial_x)
            f_x = sm.sympify(f_function).subs(x_in, initial_x)
            previous_x = initial_x
            error = float("inf")
            results[iter_count] = [int(iter_count), str(initial_x), str(g_x), str(f_x), "N/A"]
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                current_x = g_x
                g_x = sm.sympify(g_function).subs(x_in, current_x)
                f_x = sm.sympify(f_function).subs(x_in, current_x)
                error = abs(previous_x-current_x)
                previous_x = current_x
                results[iter_count] = [str(iter_count), str(current_x), str(g_x), str(f_x), str(error)]
                if not isinstance(error, float):
                    error = float("inf")
            if error <= tolerance:
                iter_count += 1
                #results[iter_count] = ["Se encontró una aproximación de la raiz en {}".format(current_x)]
            else:
                iter_count += 1
                #results[iter_count] = ["No se encontró una aproximación de la raiz. Último valor de x: {}".format(current_x)]
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e) + str(repr(traceback.format_exc()))
    try:
        aux = json.dumps(results)
        print(aux)
    except BaseException as e:
        print("Error processing results: " + str(e))

fixedPoint(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])