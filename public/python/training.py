# Numerical
import numpy as np

# Data Fetcher
import pandas as pd

# Parse Date
from datetime import datetime

# Graph Plot
import matplotlib.pyplot as plt

# Math
import math

# Replace character
import re

# Preprocessing
from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import mean_absolute_percentage_error

# LSTM Model
from keras.models import Sequential
from keras.layers import Dense, LSTM

# Configuration to database (read from .env laravel)
import os
import mysql.connector

host = os.environ.get("DB_HOST")
user = os.environ.get("DB_USERNAME")
password = os.environ.get("DB_PASSWORD")
database = os.environ.get("DB_DATABASE")

mydb = mysql.connector.connect(
    host = host,
    user = user,
    password = password,
    database = database
)

mycursor = mydb.cursor()

FIELD_DATE = 'tanggal'

def training(comodity, dateRange):
    # Format dan parsing tanggal
    dateStart = datetime.strptime(dateRange[0], '%Y/%m/%d').timestamp()
    dateEnd = datetime.strptime(dateRange[1], '%Y/%m/%d').timestamp()
    dateStartStr = dateRange[0].replace('/', '-')
    dateEndStr = dateRange[1].replace('/', '-')

    # Prepare dataframe
    df = None

    # Baca dan parsing data sebagai time series
    dateParse = lambda x: datetime.strptime(x, "%Y-%m-%d")
    df = pd.read_sql(header = 'infer', parse_dates=[FIELD_DATE], date_parser = dateParse)
    df.sort_values(by=FIELD_DATE)

    # Ambil minimum tanggal dari data
    dtMin = df.loc[df.index.min(), FIELD_DATE]
    timestamp = dtMin.timestamp()
    dtMin = int(timestamp) * 1000

    # Ambil maximum tanggal dari data
    dtMax = df.loc[df.index.max(), FIELD_DATE]
    timestamp = dtMax.timestamp()
    dtMax = int(timestamp) * 1000

    # Normalisasi
    scaler = MinMaxScaler(feature_range=(0, 1))
    data = np.array(df)
    dataset = scaler.fit_transform(data)

    return (dataset)