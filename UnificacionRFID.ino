#include <SPI.h>
#include <MFRC522.h>
//NEW
#include <SoftwareSerial.h>
SoftwareSerial BT1(3, 2);  //Rx |  Tx
//const char* texto;
//NEW

#define RST_PIN         9          // Configurable, see typical pin layout above
#define SS_PIN          10         // Configurable, see typical pin layout above

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Crear la instancia de MFRC522
/*
PCD - Proximity Coupling Device (Lector)
PICC - Proximity Integrated Circuit Chip (tarjeta)
*/
void setup() {
  pinMode(7, INPUT);
  Serial.begin(9600);   // Iniciar comunicacion serial con PC
  while (!Serial);    // No hacer nada si el puerto serial esta abierto (added for Arduinos based on ATMEGA32U4)
  SPI.begin();      // Iniciamos el BUS SPI
  BT1.begin(9600);
  mfrc522.PCD_Init();   // Iniciamos el lector MFRC522
  delay(4);       // Optional delay. Some board do need more time after init to be ready, see Readme
  //mfrc522.PCD_DumpVersionToSerial();  // Show details of PCD - MFRC522 Card Reader details
  //Serial.println(F("Scan PICC to see UID, SAK, type, and data blocks..."));
}

void loop() {
  // Resetea el ciclo si no hay una tarjeta presente en el lectior.

  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }
  // Si detecta una tarjeta pero no puede obtener informacion reseteamos nuevamente.
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }
    //Serial.print(F("UID:"));    //Dump UID
  //String texto = "";
  //int aux2;
  //String aux3 = "";
  //Serial.print("Lei la tarjeta correctamente");
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
    Serial.print(mfrc522.uid.uidByte[i],HEX);
    BT1.print(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
    BT1.print(mfrc522.uid.uidByte[i], HEX);    //aqui mandamos la UID por serial
    //aux2 = int(mfrc522.uid.uidByte[i]);
    ///aux3= String(aux2, HEX);
    //if (aux2<16){aux3 = "0" + aux3;}
    //texto+= aux3;
}
//Serial.println(texto);
     BT1.println();    //En este bucle leemos lo que el WiFi muestra por serial
     Serial.println();
     delay(10);
     int valor = 0;
     String c = "";
     while(valor==0){
     c = BT1.readStringUntil('\n');
     Serial.print(c);
     Serial.println();
     delay(10);
     valor = digitalRead(7);
     }
     delay(1000);
     valor=0;
}
