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
    global cap,  conteo, parpadeo, img_info, paso

    #Checar video captura
    if cap is not NONE:
        
        ret, frame = cap.read()

        #Redimencionar
        frame = imutils.resize(frame, width = 1280)

        #Frame rgb modificable
        frameRGB = cv2.cvtColor(frame, cv2.COLOR_BGR2RG)


        #Frame a mostrar y cambiar de color
        frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RG)

        if ret == True:
            
            #Agregar malla facial
            res = MallaFacial.process(frameRGB)

            #Lista de resultados

            px = []
            py = []
            lista = []

            if res.multi_face_landmarks:
                #Extraer mallas faciales
                for rostros in res.multi_face_landmarks:
                    #Dibujar
                    mpDibujo.draw_landmarks(frame, rostros, MafaObj.FACE_CONNECTIONS, confiDibujo, confiDibujo)
            
        #Convertir video
        im = Image.fromarray(frame)
        img = ImageTk.PhotoImage(image = im)

        #Mostrar video
        lblVideo.configure(image = img)
        lblVideo.image = img
        lblVideo.after(10, Ingresar)
    
    else:
        cap.release()






#Paths 

SalidaRostros = "C:/Users/GenaroSigalaAlvarado/Documents/GitHub/SIMP2.0/Rostros"
ChecadorRostros = "C:/Users/GenaroSigalaAlvarado/Documents/GitHub/SIMP2.0/Rostros/"

#variables


#rango estra a la cara
rangoy = 30
rangox = 20

#exactitud de deteccion
Detect = 0.5 


#herramienta de dibujo
mpDibujo = mp.solutions.drawing_utils
confiDibujo = mpDibujo.DrawingSpec(thickness = 1, circle_radius = 1)


#malla facial como objeto
MafaObj =  mp.solutions.face_mesh
MallaFacial = MafaObj.FaceMesh(max_num_faces = 1)



#objeto detector de caras
ObjetoDet = mp.solutions.face_detection
Detector = ObjetoDet.FaceDetection(min_detection_confidence = 0.5, model_selection = 1)


#por si se ocupa informacion local
info = []




#Ventana principal
pantalla = Tk()
pantalla.title("Reconocimiento")
pantalla.geometry("1280x720")

    
    
    #label de video
lblVideo = Label(pantalla)
lblVideo.place(x=0, y=0)

    #captura de video
cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)
cap.set(3, 1280)
cap.set(4, 720)


Ingresar()

pantalla.mainloop()



