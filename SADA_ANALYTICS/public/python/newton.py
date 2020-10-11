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
iter_count: Iterations number
prev_x : Solution
prev_f : Function evaluated in x
E : error

@author: Juan Sebastián Pérez Salazar
"""

import sympy as sm
import math
import sys

def newton(f, df, x_0, tolerance, n_max):
    results = {}
    
    try:
        f = str(f)
        df = str(df)
        x_0 = float(x_0)
        tolerance = float(tolerance)
        n_max = int(n_max)
        
        x_in = sm.symbols('x')
        
        if tolerance <= 0:
            raise Exception("Tolerance must be positive")
        elif n_max > 0:
            prev_x = x_0
            prev_f = sm.sympify(f).subs(x_in, prev_x)
            E = float("inf")
            iter_count = 0
            results[iter_count] = [int(iter_count), float(prev_x), float(prev_f), "N/A"]
            
            while E > tolerance and iter_count < n_max:
                prev_df = sm.sympify(df).subs(x_in, prev_x)
                
                if prev_df == 0:
                    raise Exception("Zero derivative. No solution found.")
                
                current_x = prev_x - prev_f/prev_df
                current_f = sm.sympify(f).subs(x_in, current_x)
                E = abs(current_x - prev_x)
                iter_count = iter_count + 1
                prev_x = current_x
                prev_f = current_f
                results[iter_count] = [int(iter_count), float(prev_x), float(prev_f), float(E)]
        else:
            raise Exception("Iterations number must be greater than 0")
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e)
        
    try:
        aux = json.dumps(results)
        print(aux)
    except BaseException as e:
        print("Error processing results: " + str(e))
  
newton("ln((sin(x)^2)+1)-(1/2)", "2*((sin(x)^2)+1)^(-1)*sin(x)*cos(x)", 0.5, 0.0000001, 100)