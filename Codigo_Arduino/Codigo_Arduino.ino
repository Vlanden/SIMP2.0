const int pins[7] = {2, 3, 4, 5, 6, 7, 8}; 

const byte ListNumeros[3] = {0b0111111, 0b0000110, 0b1011011};

int option;

void setup() {
  
  Serial.begin(9600);
  for(int i = 0; i < 7; i++) {
    pinMode(pins[i], OUTPUT);

  }
  BuscarPines(0);

}

void loop() {

  if (Serial.available() > 0) {
    option = Serial.read();

    if (option == '1') {
      BuscarPines(1);

    }
    if (option == '2') {
      BuscarPines(2);
    }
    delay(5000);
    BuscarPines(0);
  }
}

void BuscarPines(int numero) {
  byte NumeroBit = ListNumeros[numero];
  for(int i = 0; i < 7; i++) {
    int bit = bitRead(NumeroBit, i);
    digitalWrite(pins[i], bit);
  }
}


