
import sympy as sm
import math
import sys
import traceback
print(sys.argv)
def fixedPoint(f_function, g_function, initial_x, tolerance, iterations):
    print(sys.argv)
    try:
        if tolerance <= 0:
            print("Tolerance must be positive")
            sys.exit(1)
        elif iterations <= 0:
            print("The number of iterations must be greater than 0")
            sys.exit(1)
        else:
            iter_count = 0
            results = []
            x_in = sm.symbols('x')
            g_x = sm.sympify(g_function).subs(x_in, initial_x)
            f_x = sm.sympify(f_function).subs(x_in, initial_x)
            previous_x = initial_x
            error = float("inf")
            results.append([iter_count, initial_x, g_x, f_x, "N/A"])
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                current_x = g_x
                g_x = sm.sympify(g_function).subs(x_in, current_x)
                f_x = sm.sympify(f_function).subs(x_in, current_x)
                error = abs(previous_x-current_x)
                previous_x = current_x
                results.append([iter_count, current_x, g_x, f_x, error])
            if error <= tolerance:
                results.append("Se encontró una aproximación de la raiz en {}".format(current_x))
            else:
                results.append("No se encontró una aproximación de la raiz. Último valor de x: {}".format(current_x))
            for row in results:
                print(row)
    except:
        e = sys.exc_info()[0]
        print(e)
        print(traceback.format_exc())
fixedPoint(str(sys.argv[1]),str(sys.argv[2]),float(sys.argv[3]),float(sys.argv[4]),int(sys.argv[5]))