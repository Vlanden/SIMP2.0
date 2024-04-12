import cv2
import mediapipe as mp
import face_recognition as fr
import numpy
import os 
import math
from tkinter import *
from PIL import Image, ImageTk
import imutils

#Funcion Sing

def Ingresar():
    global cap, lblVideo, conteo, parpadeo, img_info, paso
    #Ventana principal

    pantalla = Tk()
    pantalla.title("Reconocimiento")
    pantalla.geometry("1280x720")
    pantalla.mainloop()

    #label de video
    lblVideo = Label(pantalla)
    lblVideo.place(x=0, y=0)

    #captura de video
    cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)
    cap.set(3, 1280)
    cap.set(4, 720)

    #Checar video captura
    if cap is not NONE:
        ret, frame = cap.read()

        #Redimencionar
        frame = imutils.resize(frame, width=1280)

        #Convertir video
        im = Image.fromarray(frame)
        img = ImageTk.PhotoImage(image=im)

        #Mostrar video
        lblVideo.configure(image= img)
        lblVideo.image = img
        lblVideo.after(10, )







#Paths 

SalidaRostros = "C:/Users/GenaroSigalaAlvarado/Documents/GitHub/SIMP2.0/Rostros"
ChecadorRostros = "C:/Users/GenaroSigalaAlvarado/Documents/GitHub/SIMP2.0/Rostros/"

#variables

#por si se ocupa informacion local
info = []







