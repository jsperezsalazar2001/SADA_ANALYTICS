
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
            results[iter_count] = [int(iter_count), float(initial_x), float(g_x), float(f_x), "N/A"]
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                current_x = g_x
                g_x = sm.sympify(g_function).subs(x_in, current_x)
                f_x = sm.sympify(f_function).subs(x_in, current_x)
                error = abs(previous_x-current_x)
                previous_x = current_x
                results[iter_count] = [int(iter_count), float(current_x), float(g_x), float(f_x), float(error)]
            if error <= tolerance:
                iter_count += 1
                #results[iter_count] = ["Se encontró una aproximación de la raiz en {}".format(current_x)]
            else:
                iter_count += 1
                #results[iter_count] = ["No se encontró una aproximación de la raiz. Último valor de x: {}".format(current_x)]
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e)
    aux = json.dumps(results)
    print(aux)
fixedPoint(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])