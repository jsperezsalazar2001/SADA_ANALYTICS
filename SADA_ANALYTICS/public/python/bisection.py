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
x : Solution
iter: Iterations number
err : error

@author: Juan Sebastián Pérez Salazar
"""

import sympy as sm
import math
import sys

def bisection(f, a, b, tol, n_max):
    a = float(a)
    b = float(b)
    
    results = []
    x_in = sm.symbols('x')
    f_a = sm.sympify(f).subs(x_in, a)
    f_b = sm.sympify(f).subs(x_in, b)
    
    if f_a * f_b >= 0:
        print("Bisection method fails.")
        sys.exit(1)
    elif n_max > 0:
        mp = (a + b)/2
        f_mp = sm.sympify(f).subs(x_in, mp)
        E = 1000
        cont = 1
        results.append([cont, a, mp, b, f_mp, E])
        
        while E > tol and cont < n_max:
            if f_a * f_mp < 0:
                b = mp
            else:
                a = mp
            
            p_0 = mp
            mp = (a + b)/2
            f_mp = sm.sympify(f).subs(x_in, mp)
            E = abs(mp - p_0)
            cont = cont + 1
            results.append([cont, a, mp, b, f_mp, E])
    else:
        print("Iterations number must be greater than 0")
        sys.exit(1);
        
    for values in results:
        print(values[4])

bisection("ln((sin(x)^2)+1)-(1/2)", 0, 1, 0.0000001, 100)