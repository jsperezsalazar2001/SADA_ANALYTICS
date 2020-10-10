import sympy as sm
import math
import sys
import json
import base64

def muller(x_0, x_1, x_2, tolerancia, funcion, limite_Iteraciones):
    resultados = {}
    if x_0 == x_1:
        resultados[0] = "Error x0 debe ser diferente de x1"
    elif tolerancia <= 0:
        resultados[0] = "Error La tolerancia debe ser positiva y mayor a cero" 
    elif limite_Iteraciones <= 0:
        resultados[0] = "Error Las iteraciones deben ser positivas y mayor a cero"
    else:
        x = sm.symbols('x')
        if (sm.sympify(funcion).subs(x,x_0) > 0 and sm.sympify(funcion).subs(x,x_1) < 0) or (sm.sympify(funcion).subs(x,x_0) < 0 and sm.sympify(funcion).subs(x,x_1) > 0):
            contador = 0
            error = abs(x_1-x_2)
            while (error > tolerancia) and (contador < limite_Iteraciones):
                h_0 = x_1 - x_0
                h_1 = x_2 - x_1
                f_x0 = sm.sympify(funcion).subs(x,x_0)
                f_x1 = sm.sympify(funcion).subs(x,x_1)
                f_x2 = sm.sympify(funcion).subs(x,x_2)
                delta_0 = (f_x1-f_x0)/h_0
                delta_1 = (f_x2-f_x1)/h_1
                a = (delta_1-delta_0)/(h_1-h_0)
                b = (a*h_1)+delta_1
                c = f_x2
                try:
                    raiz = math.sqrt((b**2)-(4*a*c))
                    if b<0:
                        denominador = b-raiz
                    else:
                        denominador = b+raiz
                    x_3 = x_2 + ((-2*c)/denominador)
                    x_0 = x_1
                    x_1 = x_2
                    x_2 = x_3
                    error = abs(x_1-x_2)
                    resultados[contador] = [contador,float(x_2),float(f_x2),float(error)]
                    contador = contador + 1
                except:
                    resultados[0] = "Error en los datos, prueba con otras aproximaciones diferentes"
        else:
            resultados[0] = "Error en los datos iniciales, No hay una raiz en lo x iniciales" 
    aux = json.dumps(resultados)
    print(aux)

muller(float(sys.argv[1]),float(sys.argv[2]),float(sys.argv[3]),float(sys.argv[4]),str(sys.argv[5]),int(sys.argv[6]))