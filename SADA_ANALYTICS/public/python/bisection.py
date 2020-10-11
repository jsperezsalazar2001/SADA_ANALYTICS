"""
Created on Mon Oct  5 
This program found the solution of ecuation f(x) = 0 on interval [a, b] by bisection method.

Parameters
----------
f : Continue function
a : Right limit of initial interval
b : Left limit of initial interval
tol : Tolerance
n_max : Maximum number of iterations

Returns
-------
iter: Iterations number
a : Left limit of interval
mp: Solution
b: Right limit of interval
f_mp: Function evaluated in middle point
E : error

@author: Juan Sebastián Pérez Salazar
"""

import sympy as sm
import math
import sys
import traceback
import json
import base64

def bisection(f, a, b, tolerance, n_max):
    results = {}
    try:
        f = str(f)
        a = float(a)
        b = float(b)
        tolerance = float(tolerance)
        n_max = int(n_max)
        
        x_in = sm.symbols('x')
        
        f_a = sm.sympify(f).subs(x_in, a)
        f_b = sm.sympify(f).subs(x_in, b)
        
        if tolerance <= 0:
            raise Exception("Tolerance must be positive.")
        elif f_a * f_b >= 0:
            raise Exception("Bisection method fails.")
        elif n_max > 0:
            mp = (a + b)/2
            f_mp = sm.sympify(f).subs(x_in, mp)
            E = float("inf")
            iter_count = 1
            results[iter_count] = [int(iter_count), float(a), float(mp), float(b), float(f_mp), "N/A"]
            
            while E > tolerance and iter_count < n_max:
                iter_count = iter_count + 1
                if f_a * f_mp < 0:
                    b = mp
                else:
                    a = mp
                
                p_0 = mp
                mp = (a + b)/2
                f_mp = sm.sympify(f).subs(x_in, mp)
                E = abs(mp - p_0)
                results[iter_count] = [int(iter_count), float(a), float(mp), float(b), float(f_mp), float(E)]
        else:
            raise Exception("Iterations number must be greater than 0.")
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e)
        
    try:
        aux = json.dumps(results)
        print(aux)
    except BaseException as e:
        print("Error processing results: " + str(e))

bisection("ln((sin(x)^2)+1)-(1/2)", 0, 1, 0.0000001, 100)