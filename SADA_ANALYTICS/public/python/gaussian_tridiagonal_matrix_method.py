"""
Created on Sun Nov 8
...
Parameters
----------
...

Returns
-------
...
@author: Daniel Felipe Gomez Martinez
"""
import numpy as np
import matrix_function

def gaussianTridiagonalMatrixMethod(a, b, c, d):
    dic = {}
    n = len(d)  # número de filas
    matrix = np.zeros((n,n))
    matrix[0][0] = b[0]
    for i in range(n-1):
        m = a[i]/b[i]
        matrix[i+1][i+1] = b[i+1] = b[i+1] - (m*c[i])
        matrix[i][i+1] = c[i]
        d[i+1] = d[i+1] - (m*d[i])

    d = np.array(d)
    dic[0] = matrix
    matrix_function.rebuild_matrix(dic)
    x = matrix_function.soltion(matrix, d)
    # for lop only for print result
    print("final matrix: ")
    for i in dic.keys():
        for j in range(len(dic[i])):
            print(dic[i][j])
    print("x solutions ")
    print(x)
    return dic,x

"""a = [1,-4,3,5,7]
b = [5,4,10,12,-25,12]
c = [2,2,3,-8,4]
d = [12,24,-8,13,-30,9]"""

"""a = [1,4]
b = [2,2,2]
c = [6,1]
d = [8,4,6]"""

a = [-1,-1]
b = [2,2,2]
c = [-1,-1]
d = [124,4,14]

dic,x = gaussianTridiagonalMatrixMethod(a, b, c, d)