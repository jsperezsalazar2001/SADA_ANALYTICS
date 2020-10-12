"""
Created on Mon Oct  5 
This program found the solution of ecuation f(x) = 0 until the iteration limit is reached

Parameters
----------
function : Continue function
x_0 : initial x
delta: change on x
iterations : Maximum number of iterations

Returns
-------
results : array with data from each iteration

@author: César Andrés García Posada
"""

import sympy as sm
import math
import sys
import json
import base64

def incremental_search(x_0, delta, iterations, function):
    x_0 = float(x_0)
    delta = float(delta)
    iterations = int(iterations)
    results = {}
    if delta <= 0:
        results[0] = "Error delta has to be positive and greater than 0"
    elif iterations > 0:
        results = {}
        x = sm.symbols('x')
        previous_x = x_0
        current_x = previous_x+delta
        previous_f = sm.sympify(function).subs(x,previous_x)
        current_f = sm.sympify(function).subs(x,current_x)
        count = 0 
        while (count < iterations):
            if current_f*previous_f<0:
                results[count] = [previous_x,current_x]
            previous_x = current_x
            current_x = current_x + delta
            previous_f = current_f
            current_f = sm.sympify(function).subs(x,current_x)
            count = count + 1
    else:
        results[0] = "Error the iterations has to be positive and greater than 0"
    aux = json.dumps(results)
    print(aux)

incremental_search(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4])
