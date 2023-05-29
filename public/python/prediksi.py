import pandas as pd
import numpy as np
from datetime import datetime 
from training import handlePreprosesing

# Penambahan n-day data prediksi
NEXT_PREDICTION = 30

# Kolom yang diambil dari file (data)
FIELD_DATE = 'tanggal'

df_baru, df_asli = handlePreprosesing()

def addPrediksi():
    
    # Tambah data prediksi
    endTs = endTs + NEXT_PREDICTION
    dateNextEnd = datetime.fromtimestamp(endTs/1000)
    print('Tambah data hingga tanggal: ' + dateNextEnd.strftime("%Y-%m-%d"))

    # Buat filter
    mask = (df_asli[FIELD_DATE])