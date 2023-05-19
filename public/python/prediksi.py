# Numerical
import numpy as np

# Data Fetcher
import pandas as pd

# Parse Date
from datetime import datetime

# Graph Plot
import matplotlib.pyplot as plt

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

# Parse and Pre-Processing Data
def handlePreprosesing(comodity, dateRange):
    # Format and Parse Date
    dateStart = datetime.strptime(dateRange[0], '%Y/%m/%d').timestamp()
    dateEnd = datetime.strptime(dateRange[1], '%Y/%m/%d').timestamp()
    dateStartStr = dateRange[0].replace('/', '-')
    dateEndStr = dateRange[1].replace('/', '-')

    # Remove Any Alpha Numeric
    # safeComName = re.sub(r'\W+', '', comodity)
    
    # Get Minimum Timestamp of Data

    return

def handlePrediksi():

    return