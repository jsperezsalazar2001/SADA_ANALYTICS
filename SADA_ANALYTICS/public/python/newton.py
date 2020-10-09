# -*- coding: utf-8 -*-
"""
Created on Mon Oct  5 
This program found the solution of ecuation f(x) = 0 by Newton's method.

Parameters
----------
f : Continue function
f' : Continue function
x_0 : initial aproximation
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

def newton(f, df, x_0, tol, n_max):
    x_0 = float(x_0)
    
    results = []
    x_in = sm.symbols('x')
    if n_max > 0:
        prev_x = x_0
        prev_f = sm.sympify(f).subs(x_in, prev_x)
        E = 1000
        cont = 0
        results.append([cont, prev_x, prev_f])
        
        while E > tol and cont < n_max:
            prev_df = sm.sympify(df).subs(x_in, prev_x)
            
            if prev_df == 0:
                print("Zero derivative. No solution found.")
                sys.exit(1)
            
            current_x = prev_x - prev_f/prev_df
            current_f = sm.sympify(f).subs(x_in, current_x)
            E = abs(current_x - prev_x)
            cont = cont + 1
            prev_x = current_x
            prev_f = current_f
            results.append([cont, prev_x, prev_f, E])
    else:
        print("Iterations number must be greater than 0")
        sys.exit(1);
        
    for values in results:
        print(str(values[2]))
        
  
newton("ln((sin(x)^2)+1)-(1/2)", "2*((sin(x)^2)+1)^(-1)*sin(x)*cos(x)", 0.5, 0.0000001, 100)