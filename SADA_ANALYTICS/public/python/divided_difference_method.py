"""
Created on Wednesday Nov 11
Parameters
----------
a: constant vector
b: constant vector 
Returns
-------

@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import matrix_function
import json
import sys
np.set_printoptions(precision=7)

def dividedDifferenceMethod(a,b):
    dic ={}
    
    a = a.replace('[', '').replace(']', '').split(',')
    b = b.replace('[', '').replace(']', '').split(',')
    a = np.array(a, dtype=float)
    b = np.array(b, dtype=float)
    
    validate = False
    unique_elements, counts_elements = np.unique(a, return_counts=True)
    
    for i in counts_elements:
        if(i>1):
            validate=True
            break
    if (validate):
        dic[0]="Error hay puntos iguales"
    else:
        n = len(a)
        D = np.zeros((n,n))

        D[:,0] = b.T

        for i in range(1,n):
            aux0 = D[i-1:n,i-1]
            aux1 = np.diff(aux0)
            aux2 = np.subtract(a[i:n],a[0:n-1-i+1])
            D[i:n,i] = np.divide(aux1,np.transpose(aux2))

        res = np.diag(D)

        polynomial = '' + '{0:+}'.format(res[0])
        m = '(x' + '{0:+}'.format(-a[0]) + ')'
        for i in range(1,n):
            polynomial += '{0:+}'.format(res[i]) + m
            m += '(x' + '{0:+}'.format(-a[i]) + ')'
        polynomial = polynomial.replace('x+0','x')



        dic["v_matrix"] = D
        dic = matrix_function.rebuild_matrix(dic)
        dic["coef"] = str(res)
        dic["polynomial"] = polynomial
    
    print(json.dumps(dic))
    

#x = [-1, 0, 3, 4]
#y = [15.5, 3, 8, 1]

#x = [-2,-1,0,2,3,6]
#y = [-18,-5,-2,-2,7,142]

dividedDifferenceMethod(sys.argv[1],sys.argv[2])