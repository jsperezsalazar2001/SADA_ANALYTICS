# -*- coding: utf-8 -*-
"""
Created on Mon Oct  5
This program found the solution of ecuation f(x) = 0 on interval [a, b] by false position method method.

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

def false_position(f, a, b, tol, n_max):
    a = float(a)
    b = float(b)
    
    results = []
    x_in = sm.symbols('x')
    
    if n_max > 0:
        f_a = sm.sympify(f).subs(x_in, a)
        f_b = sm.sympify(f).subs(x_in, b) 
        mp = (f_b*a - f_a*b)/(f_b - f_a)
        f_mp = sm.sympify(f).subs(x_in, mp) 
        E = 1000
        cont = 1
        results.append([cont, a, mp, b, f_mp, E])
        
        while E > tol and cont < n_max:
            if f_a * f_mp < 0:
                b = mp
            else:
                a = mp
            
            f_a = sm.sympify(f).subs(x_in, a)
            f_b = sm.sympify(f).subs(x_in, b)
            p_0 = mp
            mp = (f_b*a - f_a*b)/(f_b - f_a)
            f_mp = sm.sympify(f).subs(x_in, mp) 
            E = abs(mp - p_0)
            cont = cont + 1
            results.append([cont, a, mp, b, f_mp, E])
    else:
        print("Iterations number must be greater than 0")
        sys.exit(1);
        
    for values in results:
        print(values[4])

false_position("ln((sin(x)^2)+1)-(1/2)", 0, 1, 0.0000001, 100)