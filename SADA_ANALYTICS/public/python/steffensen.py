
"""
Created on Sat Oct  10 
This program finds the solution to the ecuation f(x) = 0 using Steffensen's method.

Parameters
----------
f_function : Continuous  function
initial_x : Initial aproximation
tolerance : Error tolerance
iterations : Maximum number of iterations

Returns
-------
Table of results:
    columns:
    - Iteration
    - f(xi)
    - xi
    - xi + f(xi)
    - f(xi + f(xi))
    - Error

@author: Yhoan Alejandro Guzman Garcia
"""
import sympy as sm
import math
import sys
import traceback
import json
import base64
def steffensen(f_function, initial_x, tolerance, iterations):
    results = {}
    try:
        f_function = str(f_function)
        initial_x = float(initial_x)
        tolerance = float(tolerance)
        iterations = int(iterations)
        if tolerance <= 0:
            raise Exception("Tolerance must be positive")
        elif iterations <= 0:
            raise Exception("The number of iterations must be greater than 0")
        else:
            iter_count = 0
            x_in = sm.symbols('x')
            f_initial_x = sm.sympify(f_function).subs(x_in, initial_x)
            xi_plus_f_xi = initial_x + f_initial_x 
            f_xi_plus_f_xi = sm.sympify(f_function).subs(x_in, xi_plus_f_xi)
            error = float("inf")
            results[iter_count] = [int(iter_count), float(initial_x), float(f_initial_x), float(xi_plus_f_xi), float(f_xi_plus_f_xi), "N/A"]
            previous_x = initial_x
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                first_term = previous_x
                f_previous_x = sm.sympify(f_function).subs(x_in, previous_x)
                second_term = f_previous_x**2
                second_term /= (sm.sympify(f_function).subs(x_in, previous_x + f_previous_x) - f_previous_x)
                current_x = first_term - second_term
                f_current_x = sm.sympify(f_function).subs(x_in, current_x)
                xi_plus_f_xi = current_x + f_current_x
                f_xi_plus_f_xi = sm.sympify(f_function).subs(x_in, xi_plus_f_xi)
                error = abs(previous_x - current_x)
                results[iter_count] = [int(iter_count), float(current_x), float(f_current_x), float(xi_plus_f_xi), float(f_xi_plus_f_xi), float(error)]
                previous_x = current_x
            if error <= tolerance:
                iter_count += 1
                #results[iter_count] = ["Se encontró una aproximación de la raiz en {}".format(current_x)]
            else:
                iter_count += 1
                #results[iter_count] = ["No se encontró una aproximación de la raiz. Último valor de x: {}".format(current_x)]
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e)
    try:
        aux = json.dumps(results)
        print(aux)
    except BaseException as e:
        print("Error processing results: " + str(e))
steffensen(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4])