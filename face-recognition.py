#nota: la ilumnacion es importante para que se ejecute el programa, sin iluminacion adecuada no se ejecutara
import cv2
import mediapipe as mp
from mediapipe.tasks import python
from mediapipe.tasks.python import vision
import face_recognition as fr
import numpy as np
import os 
import math
from tkinter import *
from PIL import Image, ImageTk
import imutils
import requests
import pymysql

def cerrar():
    if Entry.winfo_viewable() == 1:
        print()

def VerDir():

    if os.path.exists("Rostros") == False:

        os.mkdir("Rostros")
        Salida = os.getcwd()

        Salida = Salida + "/Rostros"
        Salida2 = Salida + "/Rostros/"
        ListPaths = []
        ListPaths = [Salida, Salida2]
        return ListPaths
    else:
        Salida = os.getcwd()
        Salida = Salida + "/Rostros"
        Salida2 = Salida + "/"
        ListPaths = [Salida, Salida2]
        return ListPaths

        


def Cual_Entra():

    global entrada
    entrada = input("Ingresa el nivel de entrada: ")
    entrada = int(entrada)

    if entrada == 1:
        sql = "SELECT * FROM `TablaSIMPUsuario`"
        return sql
    elif entrada == 2:
        sql = "SELECT * FROM `TablaSIMPUsuario` WHERE Id >= '2'"
        return sql
    elif entrada == 3:
        sql = "SELECT * FROM `TablaSIMPUsuario` WHERE Id >= '3'"
        return sql
    elif entrada == 5:
        sql = "SELECT * FROM `TablaSIMPUsuario` WHERE Id >= '4'"
        return sql        
    else:
        print("no se ingreso nivel de acceso")


def conexion():

    global entrada
    conexion = pymysql.connect(
        host="srv1440.hstgr.io",
        user="u227462272_Usuario_pru",
        password="gsA123456",
        db="u227462272_SIMP_pru"
    )

    cursor = conexion.cursor()

    sql = Cual_Entra()

    cursor.execute(sql)

    lista = cursor.fetchall()

    return lista


def descargar():

    global entrada
    
    for search in conexion():

        print(search[3])

        response = requests.get(search[3])

        with open(f"Rostros/{search[0]}.png", "wb") as file:
            file.write(response.content)


#Codificar iamgenes
def CodeFun():
    global images, clases, listarf

    #DB De las caras
    images = []
    clases = []
    listarf = os.listdir(SalidaRostros)

    for lin in listarf:

        #leer imagen
        imgdb = cv2.imread(f"{SalidaRostros}/{lin}")
        #guardar imagen 
        images.append(imgdb)

        clases.append(os.path.splitext(lin)[0])

    listacod = [] 

    for img in images:
        #cambiar color
        cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

        cod = fr.face_encodings(img)[0]

        listacod.append(cod)

    return listacod
        
def pantr():

    global pantalla, pantalla2, CaraCod, cap, lblVideo

    print("si")
    pantalla2.destroy()
    
    reinicio()


def reinicio():

    global pantalla, pantalla2, CaraCod, cap, lblVideo

    pantalla2 = Toplevel(pantalla)
    pantalla2.title("Uso")
    pantalla2.geometry("1280x720")

    #label de video
    lblVideo = Label(pantalla2)
    lblVideo.place(x=0, y=0)


    #captura de video
    cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)
    cap.set(3, 1280)
    cap.set(4, 720)

    CaraCod = CodeFun()
    Ingresar()

    time = 90
    pantalla.after(time * 1000, pantr)  

def ConvVideo():

    global im, img, lblVideo, frame
    #Convertir video
    im = Image.fromarray(frame)
    img = ImageTk.PhotoImage(image = im)

    #Mostrar video
    lblVideo.configure(image = img)
    lblVideo.image = img
    lblVideo.after(10, Ingresar)

def ProcMalla():

    global longitud1, longitud2, x5, x6, x7, x8, rostrosDet, an, al

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
            #mpDibujo.draw_landmarks(frame, rostros, MafaObj.FACEMESH_TESSELATION, confiDibujo, confiDibujo)
            # nota: nesecita tener buena iluminacion para ejecutarse
                    
            #Extraer puntos
                    
            for id, puntos in enumerate(rostros.landmark):   #no entra al for
                        
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

                    #parietal derecho
                    x5, y5 = lista[139][1:]

                    #Parietal izquierdo
                    x6, y6 = lista[368][1:]

                    #ceja derecha
                    x7, y7 = lista[70][1:]

                    #ceja izquierda
                    x8, y8 = lista[300][1:]

                    cv2.circle(frame, (x1, y1), 2, (255,0,0), cv2.FILLED)
                    
                    
                    #detector de rostros

                    
                    BbDetec()
                    
                        

def BbDetec():

    global xi, yi, anc, alt, Detect, an, al, rostrosDet
    
    rostrosDet = Detector.process(frameRGB)

    if rostrosDet.detections is not NONE:

        for cara in rostrosDet.detections:

            

            #info del recuadro : ID, BBox, Score
            score = cara.score
            score = score[0] #El score es una lista dentro de otra lista

            bbox = cara.location_data.relative_bounding_box

            if score > Detect:

                xi = bbox.xmin
                yi= bbox.ymin
                anc= bbox.width
                alt = bbox.height

                xi = int(xi * an)
                yi = int(yi * al)
                anc = int(anc * an)
                alt = int(alt * al)

                """#offset de x
                rangox = (rangox / 100) * anc
                                        
                xi = int(xi - int(rangox / 2))
                anc = int(anc + rangox)

                #offset de y
                rangoy = (rangoy / 100) + alt
                yi = int(yi - int(rangoy / 2))
                alt = int(alt + rangoy)"""

                #posible error
                if xi < 0:
                    xi = 0
                if yi < 0:
                    yi = 0
                if anc < 0:
                    anc = 0
                if alt < 0:
                    alt = 0

                PasosCont()
    else:
        Ingresar()
                                        
def PasosCont():

    global conteo, paso

    if paso == 0:

        if CentrarCara() == True:
                                            
           ContParpadeos()

           if paso == 1:
                BuscarCaras()
        else:
            conteo = 0

def CentrarCara():
    cv2.rectangle(frame, (xi,yi,anc,alt), (255,0,255), 2)

    #centrar cara
    if x7 > x5 and x8 < x6:
        cv2.rectangle(frame, (xi,yi,anc,alt), (0,0,255), 2)

        return True

def ContParpadeos():

    global parpadeo, paso, conteo
    #Contar parpadeos

    #Nota: hay q modificar el parametro de longitudes dependiendo del lugar donde se instale 
    #y la distancia a la que estara el usuario
    if longitud1 <= 10 and longitud2 <= 10 and parpadeo == False:
        conteo = conteo + 1
        parpadeo = True
    elif longitud1 > 10 and longitud2 > 10 and parpadeo == True:
        parpadeo = False

    cv2.putText(frame, f"Parpadeos: {int(conteo)}", (1070,375), cv2.FONT_HERSHEY_COMPLEX, 0.5, (255,255,255), 1)

    if conteo == 2:                                                    
        paso = 1

def BuscarCaras():

    global paso, conteo
    #buscar caras

    facess = fr.face_locations(frameRGB)
    facescod = fr.face_encodings(frameRGB, facess)
                                                    
    #iterar
    for facecod, facesloc in zip(facescod, facess):

        #Matching
        Match = fr.compare_faces(CaraCod, facecod)

        #similitud
        simi = fr.face_distance(CaraCod, facecod)

        print(simi)

        min = np.argmin(simi)
        print(min)                                     
                                                        
        if simi[min] > 0.60:
            print("Usuario no registrado")
            cv2.rectangle(frame, (xi,yi,anc,alt), (255,0,0), 2)
            paso = 0
            conteo = 0
                                                            
        else:
            print("Bienvenido", clases[min])
            cv2.rectangle(frame, (xi,yi,anc,alt), (0,255,0), 2)
            paso = 0
            conteo = 0

#Funcion Sing

def Ingresar():
    global cap,  conteo, parpadeo, img_info, paso, ret, frame, frameRGB, pantalla, pantalla2, clases, xi,yi,anc,alt
    

    #Checar video captura
    if cap is not NONE:
        
        ret, frame = cap.read()

        #Redimencionar
        frame = imutils.resize(frame, width = 1280)

        #Frame rgb modificable
        frameRGB = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)


        #Frame a mostrar y cambiar de color
        frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

        if ret == True:
            try:
                ProcMalla()
            except:
                Ingresar()

        ConvVideo()
        
    else:
        print("no jala")
        cap.release()
    
#Paths 

Ten = VerDir()
SalidaRostros = Ten[0]
ChecadorRostros = Ten[1]

#variables
paso = 0
parpadeo = False
conteo = 0

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

#CaraCod = CodeFun()
#Ingresar()
#descargar()
reinicio()
pantalla.mainloop()
















