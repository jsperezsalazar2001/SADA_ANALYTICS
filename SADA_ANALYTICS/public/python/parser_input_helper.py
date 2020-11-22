import numpy as np

def parse_input(a,b):
    try:
        split_a = a.split('],[')
        vector = b.replace('[', '').replace(']', '').split(',')
        matrix_values = ""
        final_list = []
        try:
            for row in range(len(split_a)):
                if (row == 0):
                    split_a[row] = split_a[row][2:] + ';'
                elif (row == len(split_a) - 1):
                    split_a[row] = split_a[row][:-2]
                else:
                    split_a[row] = split_a[row] + ';'
                matrix_values = matrix_values + str(split_a[row])
            matrix_values = matrix_values.split(";")
            for value in matrix_values:
                final_list.append(value.split(","))
            for i in range(len(final_list)):
                for j in range(len(final_list[i])):
                    final_list[i][j] = float(final_list[i][j])
            a = np.array(final_list, dtype=float)
            b = np.array(vector, dtype=float)
            return a, b
        except Exception as e:
            print(e)
            raise Exception("Be careful about dimensions from matrix and the vector")
    except Exception as e:
        print(e)
        raise Exception("Is not possible to transform matrix to numeric matrix take a look at the matrix's values")

def print_matrix(matrix):
    n = len(matrix)
    for i in range(n):  
        for j in range(n): 
            print(matrix[i][j], end = "\t")
        print("")

def rebuild_matrix(matrix):
    final_row = np.array([],dtype=str)
    final_value = np.array([],dtype=str)
    for row in matrix:
        for result in row.tolist():
            final_value = np.append(final_value, '{:.7f}'.format(result))
        final_row = np.append(final_row, str(final_value))
        final_value = np.array([], dtype=str)
    matrix = final_row.tolist()
    return matrix
