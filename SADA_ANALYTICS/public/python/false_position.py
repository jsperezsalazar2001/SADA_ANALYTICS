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

def false_position(f, a, b, tolerance, n_max):
    results = {}
    try:
        f = str(f)
        a = float(a)
        b = float(b)
        tolerance = float(tolerance)
        n_max = int(n_max)
        
        x_in = sm.symbols('x')
        
        if a == b:
            raise Exception("Error a Has to be different to b")
        if tolerance <= 0:
            raise Exception("Tolerance must be positive")
        elif n_max > 0:
            f_a = sm.sympify(f).subs(x_in, a)
            f_b = sm.sympify(f).subs(x_in, b) 
            mp = (f_b*a - f_a*b)/(f_b - f_a)
            f_mp = sm.sympify(f).subs(x_in, mp) 
            E = float("inf")
            iter_count = 1
            results[iter_count] = [int(iter_count), round(float(a),7), round(float(mp),7), round(float(b),7), round(float(f_mp),7), "N/A"]
            
            while E > tolerance and iter_count < n_max:
                iter_count = iter_count + 1
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
                results[iter_count] = [int(iter_count), round(float(a),7), round(float(mp),7),round(float(b),7), round(float(f_mp),7), round(float(E),7)]
        else:
            raise Exception("Iterations number must be greater than 0")
    except BaseException as e:
        results[0] = "Error in the given data: " + str(e)
        
    try:
        aux = json.dumps(results)
        print(aux)
    except BaseException as e:
        print("Error processing results: " + str(e))

false_position(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])