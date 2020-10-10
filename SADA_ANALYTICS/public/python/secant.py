import sympy as sm
import math
import sys
import traceback
def secant(f_function, x0, x1, tolerance, iterations):
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
            f_x_0 = sm.sympify(f_function).subs(x_in, x0)
            f_x_1 = sm.sympify(f_function).subs(x_in, x1)
            error = float("inf")
            results.append([iter_count, x0, f_x_0, "N/A"])
            iter_count += 1
            results.append([iter_count, x1, f_x_1, "N/A"])
            previous_x = x1
            second_previous_x = x0
            while iter_count < iterations and error > tolerance:
                iter_count += 1
                first_term = previous_x
                f_previous_x = sm.sympify(f_function).subs(x_in, previous_x)
                second_term = f_previous_x*(previous_x - second_previous_x)
                f_second_previous_x = sm.sympify(f_function).subs(x_in, second_previous_x)
                second_term /= f_previous_x-f_second_previous_x
                current_x = first_term - second_term
                f_current_x = sm.sympify(f_function).subs(x_in, current_x)
                error = abs(current_x - previous_x)
                results.append([iter_count, current_x, f_current_x, error])
                second_previous_x = previous_x
                previous_x = current_x
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
secant(str(sys.argv[1]),float(sys.argv[2]),float(sys.argv[3]),float(sys.argv[4]),int(sys.argv[5]))