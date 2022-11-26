#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <SPI.h>
String identificador;

/////MODIFICAR IP/HOST
ESP8266WiFiMulti WiFiMulti;
//const char* ssid = "TOTALPLAY-xxx_2.4Gnormal";
const char* ssid = "ryt-24";
const char* password = "m170a3ices";
//const char* ssid = "Temporal-AT";
//const char* password = "Totalplay2021";
//const char* password = "Temporal-AT";

void setup() {
  Serial.begin(115200);     //inicamos serial
  delay(10);

  // We start by connecting to a WiFi network
  WiFi.mode(WIFI_STA);  //modo estacion: se conecta a un punto de acceso
  WiFiMulti.addAP(ssid, password); //conexion multiple: eligue la de mejor señal
  //WiFiMulti.addAP(ssid_2, password_2); 
  //Serial.println();
  //Serial.println();
  //Serial.print("Esperando WiFi... ");

  while (WiFiMulti.run() != WL_CONNECTED) {  //conectamos
  //  Serial.print(".");
    delay(500);
  }

  //Serial.println("");
  //Serial.println("WiFi conectado");
  //Serial.println("Direccion IP: ");
  //Serial.println(WiFi.localIP());

  delay(500);
}

void loop() {
  const uint16_t port = 80;
  const char * host = "10.62.70.111"; // ip or dns
  
   while(!Serial.available()){
   }
   //Serial.println();
   //Serial.println("Escribe un UID: ");
   identificador = Serial.readStringUntil('\n');
   identificador = identificador.substring(0, identificador.length());
   Serial.print("Lei: ");
   Serial.println(identificador);

  //Serial.print("conectando con el host: ");
  //Serial.println(host);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;

  if (!client.connect(host, port)) {
  //  Serial.println("coneccion fallida");
  //  Serial.println("Reconectando...");
    delay(5000);
    return;
  }
  else{

 String serverPath = "/R_Aulas/index.php?id=";
         serverPath+= identificador;
  //Serial.println(serverPath);
  client.print("GET ");
  client.print(serverPath);
  client.println(" HTTP/1.0");
  client.println("Host: 10.62.70.111");
  client.println();
  
  int timeout_flag = 0;

     while (client.available() == 0) {
    static int count = 0;
//    Serial.print(".");
    delay(250);
    if (count > 12) //waiting more than 3 seconds
      timeout_flag = 1;
      break;
  }
  Serial.println();

  if (timeout_flag == 0) {
    //read all lines from server
  //  Serial.print("Respuesta del servidor: ");
    do {
      String line = client.readStringUntil('\r'); //read line by line
    //  Serial.print(line);
    } while (client.available() > 0);
    //Serial.println();
  }
  else {
    //Serial.println("Connection error. Server doesn't respond");
  }
    
  }
    //Serial.println("closing connection");
    client.stop();
    delay(10000);
}
