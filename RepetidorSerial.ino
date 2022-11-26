#include <ESP8266WiFi.h>
#include <SPI.h>
 String aux1;
void setup() {
  Serial.begin(115200);
  delay(10);
}

void loop() {
   while(!Serial.available()){}
   aux1 = Serial.readStringUntil('\n');
   aux1 = aux1.substring(0, aux1.length());
   Serial.print("Lei: ");
   Serial.println(aux1);
}
