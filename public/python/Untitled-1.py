import pandas as pd
import numpy as np

df = pd.read_csv('D:\Kuliah\Skripsi\Data Set\data_gresikkab_45_154_2016.csv')
#df = np.array(df.values[1], dtype=[('word', 'U10'), ('datetime64')])
#df['harga_current'] = df['harga_current'].astype('float')

df
#print(type(df.values[1][1]))

arr_nol = []
for x in df.values:
    if x[2] == 0:
       arr_nol.append(x)
    # print(arr_nol)

arr_nol = []
arr_total = []
rolling = 3
index = 0
for x in df.values:
    index += 1
    if x[2] == 0:
       total_rolling = index - rolling - 1
       replace_nol = 0
       rolingindex = total_rolling - 1
       for y in range(total_rolling,index):
           rolingindex += 1
           replace_nol += df.values[rolingindex][2]
       hasil = replace_nol/rolling
       arr_nol.append(hasil)
    else:
        arr_nol.append(x[1])
print(arr_nol[107])