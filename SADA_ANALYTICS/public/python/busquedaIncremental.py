import sympy as sm
import math
import sys
import json
import base64

def busquedaIncremental(x_inicial, delta, limite_Iteraciones, funcion):
    if delta <= 0:
        print("El delta debe ser positivo")
        sys.exit(1)
    elif limite_Iteraciones > 0:
        resultados = {}
        x = sm.symbols('x')
        x_anterior = x_inicial
        x_actual = x_anterior+delta
        f_anterior = sm.sympify(funcion).subs(x,x_anterior)
        f_actual = sm.sympify(funcion).subs(x,x_actual)
        contador = 0 
        while (contador < limite_Iteraciones):
            if f_actual*f_anterior<0:
                resultados[contador] = [x_anterior,x_actual]
            x_anterior = x_actual
            x_actual = x_actual + delta
            f_anterior = f_actual
            f_actual = sm.sympify(funcion).subs(x,x_actual)
            contador = contador + 1
        aux = json.dumps(resultados)
        print(aux)
    else:
        print("Las iteraciones deben ser un numero positivo")
        sys.exit(1)


def muller(x_0, x_1, tolerancia, funcion, limite_Iteraciones):
    if x_0 == x_1:
        print("Error x0 debe ser diferente de x1")
        sys.exit(1)
    elif tolerancia <= 0:
        print("La tolerancia debe ser positiva y mayor a cero")
        sys.exit(1)
    elif limite_Iteraciones <= 0:
        print("Las iteraciones deben ser positivas y mayor a cero")
        sys.exit(1)
    else:
        contador = 0
        resultados = {}
        x_0 = float(x_0)
        x_1 = float(x_1)
        x = sm.symbols('x')
        x_2 = (x_0+x_1)/2
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
            except:
                print("Error en los datos, prueba con otras aproximaciones diferentes")
                sys.exit(1)
            if b<0:
                denominador = b-raiz
            else:
                denominador = b+raiz
            x_3 = x_2 + ((-2*c)/denominador)
            x_0 = x_1
            x_1 = x_2
            x_2 = x_3
            error = abs(x_1-x_2)
            resultados[contador] = [x_0,x_1,x_2,error]
            contador = contador + 1
        for valor in resultados.values():
            print("X0: " + str(valor[0]) + ", x1: " + str(valor[1]) + ", x2: " +str(valor[2]) + " error: " + str(valor[3]))

#muller(0,1,0.0070,"(exp(-x))-x",5)
#busquedaIncremental(-3.0,0.5,100,"ln((sin(x)^2)+1)-(1/2)")
busquedaIncremental(float(sys.argv[1]),float(sys.argv[2]),int(sys.argv[3]),str(sys.argv[4]))
