#nota: la ilumnacion es importante para que se ejecute el programa, sin iluminacion adecuada no se ejecutara
import cv2
import mediapipe as mp
import face_recognition as fr
import numpy
import os 
import math
from tkinter import *
from PIL import Image, ImageTk
import imutils

os.environ['TF_ENABLE_ONEDNN_OPTS'] = '1'

#Funcion Sing

def Ingresar():
    global cap,  conteo, parpadeo, img_info, paso, ret, frame, pantalla
    

    #Checar video captura
    if cap is not NONE:
        #print("cap")
        
        ret, frame = cap.read()

        #Redimencionar
        frame = imutils.resize(frame, width = 1280)

        #Frame rgb modificable
        frameRGB = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)


        #Frame a mostrar y cambiar de color
        frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

        if ret == True:
            #
            print("ret")
            #Agregar malla facial
            res = MallaFacial.process(frameRGB)

            #Lista de resultados

            px = []
            py = []
            lista = []

            if res.multi_face_landmarks:
                print("hh")
                #Extraer mallas faciales
                
                for rostros in res.multi_face_landmarks:
                    print("gg")
                    #Dibujar
                    mpDibujo.draw_landmarks(frame, rostros, MafaObj.FACE_CONNECTIONS, confiDibujo, confiDibujo)
                    # nota: nesecita tener buena iluminacion para ejecutarse
                    print("llll")


                    #Extraer puntos
                    
                    for id, puntos in enumerate(rostros.landmask):   #no entra al for
                        print("ggg")

                        #Info de la imagen
                        al, an, ni = frame.shape
                        x = int(puntos.x * an)
                        y = int(puntos.y *al)
                        px.append(x)
                        py.append(y)
                        lista.append([id, x, y])

                        #Confirmar puntos
                        if len(lista) == 468:

                            #Ojo derecho
                            x1, y1 = lista[145][1:]
                            x2, y2 = lista[159][1:]
                            longitud1 = math.hypot(x2-x1, y2-y1)

                            #Ojo izquierdo
                            x3, y3 = lista[374][1:]
                            x4, y4 = lista[386][1:]
                            longitud2 = math.hypot(x4-x3, y4-y3)

                            #detector de rostros

                            rostrosDet = Detector.process(frameRGB)

                            if rostrosDet.detections is not NONE:

                                for cara in rostrosDet.detections:

                                    #info del recuadro : ID, BBox, Score
                                    score = cara.score
                                    score = score[0] #El score es una lista dentro de otra lista

                                    bbox = cara.location_data.relative_bounding_box

                                    if score > Detect:
                                        print("hola")



            
        #Convertir video
        im = Image.fromarray(frame)
        img = ImageTk.PhotoImage(image = im)

        #Mostrar video
        lblVideo.configure(image = img)
        lblVideo.image = img
        lblVideo.after(10, Ingresar)
    
    else:
        print("no jala")
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



