
import sympy as sm
import math
import sys
import traceback
print(sys.argv)
def steffensen(f_function, initial_x, tolerance, iterations):
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
            f_initial_x = sm.sympify(f_function).subs(x_in, initial_x)
            xi_plus_f_xi = initial_x + f_initial_x 
            f_xi_plus_f_xi = sm.sympify(f_function).subs(x_in, xi_plus_f_xi)
            error = float("inf")
            results.append([iter_count, initial_x, f_initial_x, xi_plus_f_xi, f_xi_plus_f_xi, "N/A"])
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
                results.append([iter_count, current_x, f_current_x, xi_plus_f_xi, f_xi_plus_f_xi, error])
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
steffensen(str(sys.argv[1]),float(sys.argv[2]),float(sys.argv[3]),int(sys.argv[4]))