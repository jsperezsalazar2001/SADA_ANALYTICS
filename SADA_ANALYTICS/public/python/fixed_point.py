
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
    error_dict = {}
    error_dict["error"] = False
    try:
        f_function = str(f_function)
        g_function = str(g_function)
        initial_x = float(initial_x)
        tolerance = float(tolerance)
        iterations =int(iterations)
        if f_function == g_function:
            raise Exception("f(x) and g(x) must be different")
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
            results[iter_count] = [int(iter_count), str(round(initial_x,7)), str(round(g_x,7)), str(round(f_x,7)), "N/A"]
            check_indeterminations(results[iter_count])
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                current_x = float(g_x)
                g_x = float(sm.sympify(g_function).subs(x_in, current_x))
                f_x = float(sm.sympify(f_function).subs(x_in, current_x))
                error = float(abs(previous_x-current_x))
                previous_x = current_x
                results[iter_count] = [str(iter_count), str(round(current_x,7)), str(round(g_x,7)), str(round(f_x,7)), str(round(error,7))]
                check_indeterminations(results[iter_count])
                if not isinstance(error, float):
                    error = float("inf")
                for result in results[iter_count]:
                    if str(result) == "zoo":
                        raise Exception("A division by cero was encounter while trying to evaluate the function")
                    if str(result) == "nan":
                        raise Exception("An indeterminate operation was encounter while trying to evaluate the function")
            if error <= tolerance:
                iter_count += 1
                error_dict["aprox"] = current_x
            else:
                iter_count += 1
                #results[iter_count] = ["No se encontró una aproximación de la raiz. Último valor de x: {}".format(current_x)]
    except BaseException as e:
        error_dict["error"] = "Error in the given data: " + str(e) #+ str(repr(traceback.format_exc()))
    try:
        print(json.dumps(error_dict))
        print(json.dumps(results))
    except BaseException as e:
            print('{"error": "true"}')
            
def check_indeterminations(results):
    for result in results:
        if str(result) == "zoo":
            raise Exception("A division by cero was encounter while trying to evaluate the function")
        if str(result) == "nan":
            raise Exception("An indeterminate operation was encounter while trying to evaluate the function")

fixedPoint(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])