"""
Created on Wednesday Nov 11
Parameters
----------
a: diagonal above main diagonal
b: principal diagonal
a: diagonal down the main diagonal
b: constant vector
Returns
-------
dic: step dictionary (float with decimals)
x: solution vector

@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import json
import sys
import matrix_function

def gaussianTridiagonalMatrixMethod(a, b, c, d):
    dic = {}
    a = a.replace('[', '').replace(']', '').split(',')
    b = b.replace('[', '').replace(']', '').split(',')
    c = c.replace('[', '').replace(']', '').split(',')
    d = d.replace('[', '').replace(']', '').split(',')
    
    a = np.array(a, dtype=float)
    b = np.array(b, dtype=float)
    c = np.array(c, dtype=float)
    d = np.array(d, dtype=float)

    n = len(d)  # número de filas
    matrix = np.zeros((n,n))
    matrix[0][0] = b[0]
    for i in range(n-1):
        m = a[i]/b[i]
        matrix[i+1][i+1] = b[i+1] = b[i+1] - (m*c[i])
        matrix[i][i+1] = c[i]
        d[i+1] = d[i+1] - (m*d[i])
        dic[i]=np.array(matrix)

    d = np.array(d)
    dic[n-1] = np.array(matrix)
    dic = matrix_function.rebuild_matrix(dic)
    x = matrix_function.soltion(matrix, d)
    
    dic["x"]=x.tolist()
    print(json.dumps(dic))
    
"""a = [-1,-1]
b = [2,2,2]
c = [-1,-1]
d = [124,4,14]"""

gaussianTridiagonalMatrixMethod(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4])
#gaussianTridiagonalMatrixMethod(a, b, c, d)