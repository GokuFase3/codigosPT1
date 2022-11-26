#include <SPI.h>
#include <MFRC522.h>
//NEW
#include <SoftwareSerial.h>
SoftwareSerial BT1(3, 2);  //Rx |  Tx
char c;
//NEW

#define RST_PIN         9          // Configurable, see typical pin layout above
#define SS_PIN          10         // Configurable, see typical pin layout above

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Crear la instancia de MFRC522
/*
PCD - Proximity Coupling Device (Lector)
PICC - Proximity Integrated Circuit Chip (tarjeta)
*/
void setup() {
  Serial.begin(115200);   // Iniciar comunicacion serial con PC
  while (!Serial);    // No hacer nada si el puerto serial esta abierto (added for Arduinos based on ATMEGA32U4)
  SPI.begin();      // Iniciamos el BUS SPI
  BT1.begin(115200);
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
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
}
//  if(Serial.available()){     
      for (byte i = 0; i < mfrc522.uid.size; i++) {
      BT1.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "");
      BT1.print(mfrc522.uid.uidByte[i], HEX);
      BT1.println();
       }
//}
Serial.println();
delay(2000);
}
