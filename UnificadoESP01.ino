#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <SPI.h>
String identificador;
String sala = "B-111";

/////MODIFICAR IP/HOST
ESP8266WiFiMulti WiFiMulti;
//const char* ssid = "TOTALPLAY-xxx_2.4Gnormal";
//const char* password = "Totalplay2021";
//const char* ssid = "ryt-24";
//const char* password = "m170a3ices";
const char* ssid = "Temporal-AT";
const char* password = "Temporal-AT";

void setup() {
  pinMode(2, OUTPUT);
  digitalWrite(2, HIGH);
  Serial.begin(9600);     //inicamos serial
  delay(100);
  WiFi.mode(WIFI_STA);  //modo estacion: se conecta a un punto de acceso
  WiFi.begin(ssid, password);
  //WiFiMulti.addAP(ssid, password); //conexion multiple: eligue la de mejor señal
  //WiFiMulti.addAP(ssid_2, password_2); 
  //Serial.println();
  //Serial.print("Esperando WiFi... ");
  //while (WiFiMulti.run() != WL_CONNECTED) {  //conectamos
  while (WiFi.status() != WL_CONNECTED){
  delay(500);
  //Serial.print(".");
  }
  //Serial.print(".");
  //delay(500);
  //}
  digitalWrite(2, LOW);
  //Serial.println();
  //Serial.println("WiFi conectado");
  //Serial.println("Direccion IP: ");
  //Serial.println(WiFi.localIP());
  delay(500);
}

void loop() {
  const uint16_t port = 80;
  const char * host = "10.2.78.17"; // ip or dns
   digitalWrite(2, LOW);
   while(!Serial.available()){
   }
   //Serial.println();
   identificador = Serial.readStringUntil('\n');     //aqui leemos el UID
   identificador = identificador.substring(0, identificador.length()-1);
   //Serial.print("Lei: ");
   //Serial.println(identificador);
   //Serial.print("Longitud de UID: ");
   //Serial.println(identificador.length());
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  if (!client.connect(host, port)) {
    //Serial.println("coneccion fallida");
    //Serial.println("Reconectando...");
    digitalWrite(2, HIGH);
    delay(3000);
    return;
  }
  else{
  digitalWrite(2, LOW);
 String serverPath = "/R_Aulas/index.php?id=";
         serverPath+= identificador;
         serverPath+= "&aula=";
         serverPath+= sala;
  //Serial.println(serverPath);           //aqui creamos la URL y nos conectamos al host
  //Serial.print("conectando con el host: ");
  //Serial.println(serverPath);
  client.print("GET ");
  client.print(serverPath);
  client.println(" HTTP/1.0");
  client.println("Host: 10.2.78.17");
  client.println();
  
  int timeout_flag = 0;

     while (client.available() == 0) {
    static int count = 0;
    //Serial.print(".");
    delay(250);
    if (count > 12) //waiting more than 3 seconds
      timeout_flag = 1;
      break;
  }
  //Serial.println();

  if (timeout_flag == 0) {
    //read all lines from server
    //Serial.print("Respuesta del servidor: ");
    do {
      String line = client.readStringUntil('\r'); //read line by line
      //Serial.print(line);
    } while (client.available() > 0);
      //Serial.println();
  }
  else {
    //Serial.println("Error de conexion el cliente no responde");
    digitalWrite(2, HIGH);
    delay(3000);
  }
    
 }
    //Serial.println("cerrando conexion");
    client.stop();
    delay(100);
}
