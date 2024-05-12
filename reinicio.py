import datetime
from tkinter import *
from PIL import Image, ImageTk
import imutils
import time
import datetime

from io import open
import pymysql
import requests
import os

def VerDir():

    if os.path.exists("Rostros") == False:

        os.mkdir("Rostros")
        Salida = os.getcwd()
        Salida = Salida + "/Rostros"
        entrada = input("Ingresa el nivel de entrada: ")
        return entrada

    else:
        entrada = input("Ingresa el nivel de entrada: ")
        return entrada


def Cual_Entra():

    global entrada
    entrada = int(entrada)

    if entrada == 1:
        sql = "SELECT * FROM `usuarios`"
        return sql
    elif entrada == 2:
        sql = "SELECT * FROM `usuarios` WHERE nivel >= '2'"
        return sql
    elif entrada == 3:
        sql = "SELECT * FROM `usuarios` WHERE nivel >= '3'"
        return sql
    else:
        print("no se ingreso nivel de acceso")


def conexion():

    global entrada
    conexion = pymysql.connect(
        host="localhost",
        user="root",
        password="",
        db="caras"
    )

    cursor = conexion.cursor()

    sql = Cual_Entra()

    cursor.execute(sql)

    lista = cursor.fetchall()

    return lista



def descargar():

    global entrada
    entrada = VerDir()
    for search in conexion():

        response = requests.get(search[2])

        with open(f"Rostros/{search[1]}.png", "wb") as file:
            file.write(response.content)

descargar()

"""
def pantr():

    global pantalla, pantalla2

    print("si")
    pantalla2.destroy()
    time.sleep(10)
    pantalla2 = Toplevel(pantalla)
    pantalla2.title("Uso")
    pantalla2.geometry("1280x720")
    reinicio()


def reinicio():

    global pantalla, pantalla2

    time = 10
    pantalla.after(time * 1000, pantr)
    close = pantalla2.protocol("WH_DELETE_WINDOW", pantr)


pantalla = Tk()
pantalla.title("Reconocimiento")
pantalla.geometry("1280x720")

pantalla2 = Toplevel(pantalla)
pantalla2.title("Uso")
pantalla2.geometry("1280x720")


#tiempo()
reinicio()
pantalla.mainloop()


"""
"""
import tkinter as tk
import time

class PantallaReiniciadora:
    def __init__(self, root):
        self.root = root
        self.root.title("Reconocimiento")
        self.root.geometry("1280x720")

        # Crea una ventana secundaria
        self.pantalla2 = tk.Toplevel(self.root)
        self.pantalla2.title("Uso")
        self.pantalla2.geometry("1280x720")

        # Programa el reinicio automático después de 10 segundos
        self.reinicio()

    def pantr(self):
        print("Reinicio ejecutado")
        self.pantalla2.destroy()
        self.pantalla2 = tk.Toplevel(self.root)
        self.pantalla2.title("Uso")
        self.pantalla2.geometry("1280x720")
        self.reinicio()  # Programa el siguiente reinicio

    def reinicio(self):
        tiempo_espera = 10  # 10 segundos
        self.root.after(tiempo_espera * 1000, self.pantr)

if __name__ == "__main__":
    root = tk.Tk()
    app = PantallaReiniciadora(root)
    root.mainloop()
"""


