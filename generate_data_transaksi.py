import mysql.connector
from datetime import datetime, timedelta
import random

# Fungsi untuk terhubung ke database
def connect_to_database():
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="final_project_ricky_2023"
    )
    return connection

# Fungsi untuk mendapatkan stok dari database
def get_stock(cursor):
    cursor.execute("SELECT StockID, Quantity FROM Stocks")
    stocks = cursor.fetchall()
    return dict(stocks)

# Fungsi untuk mendapatkan data stok dari database untuk transaksi
def get_stock_for_transaction(cursor, stock_id):
    cursor.execute("SELECT StockID, Quantity FROM Stocks WHERE StockID = %s", (stock_id,))
    stock = cursor.fetchone()
    return stock if stock else None

# Fungsi untuk melakukan transaksi in
def perform_transaction_in(cursor, stock_id, quantity, transaction_date):
    cursor.execute("INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) "
                   "VALUES (%s, %s, 'In', %s)", (stock_id, quantity, transaction_date))

    # Update jumlah stok setelah transaksi in
    cursor.execute("UPDATE Stocks SET Quantity = Quantity + %s WHERE StockID = %s", (quantity, stock_id))

# Fungsi untuk melakukan transaksi out
def perform_transaction_out(cursor, stock_id, quantity, transaction_date):
    cursor.execute("INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) "
                   "VALUES (%s, %s, 'Out', %s)", (stock_id, quantity, transaction_date))

    # Update jumlah stok setelah transaksi out
    cursor.execute("UPDATE Stocks SET Quantity = Quantity - %s WHERE StockID = %s", (quantity, stock_id))

# Fungsi untuk menghasilkan transaksi in
def generate_in_transactions(cursor, start_date):
    in_transaction_count = random.randint(1, 2)
    for _ in range(in_transaction_count):
        stock_id = random.choice(list(get_stock(cursor).keys()))
        transaction_date = start_date + timedelta(days=random.randint(0, 3))
        quantity = random.randint(8, 10)

        stock_data = get_stock_for_transaction(cursor, stock_id)
        if stock_data and stock_data[1] >= quantity:
            perform_transaction_in(cursor, stock_id, quantity, transaction_date)

# Fungsi untuk menghasilkan transaksi out
def generate_out_transactions(cursor, start_date):
    out_transaction_count = random.randint(6, 10)
    for _ in range(out_transaction_count):
        stock_id = random.choice(list(get_stock(cursor).keys()))
        transaction_date = start_date + timedelta(days=random.randint(0, 3))
        quantity = random.randint(1, 2)

        stock_data = get_stock_for_transaction(cursor, stock_id)
        if stock_data and stock_data[1] >= quantity:
            perform_transaction_out(cursor, stock_id, quantity, transaction_date)

# Fungsi untuk membuat transaksi dummy
def create_dummy_transactions():
    connection = connect_to_database()
    cursor = connection.cursor()

    # Data dummy untuk bulan Juli 2023
    start_date = datetime(2023, 7, 1)
    end_date = datetime(2023, 11, 30)

    while start_date <= end_date:
        generate_in_transactions(cursor, start_date)
        generate_out_transactions(cursor, start_date)
        start_date += timedelta(days=1)

    connection.commit()
    connection.close()

if __name__ == "__main__":
    create_dummy_transactions()
