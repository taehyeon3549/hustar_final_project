//#include "sys/time.h"
#include "BLEDevice.h"
#include "BLEServer.h"
#include "BLEUtils.h"
#include "BLEBeacon.h"
//#include "esp_sleep.h"
#include "KISA_HIGHT_CBC.h"
#include "DS3231.h"
#include <Wire.h>
#include <WiFi.h>


//sec miniute hour day month year
#define GPIO_DEEP_SLEEP_DURATION     10  // sleep x seconds and then wake up


BLEAdvertising *pAdvertising;

volatile SemaphoreHandle_t timerSemaphore;
portMUX_TYPE timerMux = portMUX_INITIALIZER_UNLOCKED;
volatile int interruptCounter = 0;

char MY_UUID[40] = "8ec76ea3-6668-48da-9866-75be8bc86f4d";  //default UUID...
char APP_BEACON_UUID[] = {0x8e, 0xc7, 0x6e, 0xa3, \
                          0xf0, 0xf0, 0xf0, 0xf0, \
                          0xf0, 0xf0, 0xf0, 0xf0, \
                          0x03, 0x03, 0x03, 0x94
                         };
uint8_t pbszUserKey[16] = {0x88, 0xe3, 0x4f, 0x8f, \
                           0x08, 0x17, 0x79, 0xf1, \
                           0xe9, 0xf3, 0x94, 0x37, \
                           0x0a, 0xd4, 0x05, 0x89};
uint8_t pbszIV[8] = {0x26, 0x8d, 0x66, 0xa7, \
                     0x35, 0xa8, 0x1a, 0x81};

uint8_t pbszCipherText[10] = {0x00};
uint8_t plainText[6] = {0x8e, 0xc7, 0x6e, 0xa3, \
                        0xf0, 0xf0
                       };
uint8_t nPlainTextLen = 6;
uint8_t nCipherTextLen;
char UUID_BUF[16] = {0x01, 0x01, 0x01, 0x01, \
                     0x01, 0x01, 0x01, 0x01, \
                     0x01, 0x01, 0xFF, 0xFF, \
                     0x01, 0x01, 0x01, 0x94
                    };


hw_timer_t * timer = NULL;
//DS3231 Clock;
RTClib RTC;
static DateTime now;

const char* ssid     = "SVIK_OFFICE";
const char* password = "12345678";

const char* host = "54.180.159.207";


void IRAM_ATTR onTimer() {
  portENTER_CRITICAL_ISR(&timerMux);
  interruptCounter++;
  
  
  plainText[0] = now.second();
  plainText[1] = now.minute();
  plainText[2] = now.hour();
  plainText[3] = now.day();
  plainText[4] = now.month();
  plainText[5] = now.year();

  for (int i = 0; i < 6; i++)
  {
    Serial.printf("%02x ", plainText[i]);
  }
  Serial.println();

  nCipherTextLen = HIGHT_CBC_Encrypt(pbszUserKey, pbszIV, plainText, 0, 6, pbszCipherText);
  //
  for (int i = 0; i < 8; i++)
  {
    APP_BEACON_UUID[i] = pbszCipherText[i];
  }
  sprintf(MY_UUID,"%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x-%02x%02x%02x%02x%02x%02x",APP_BEACON_UUID[0],APP_BEACON_UUID[1],\
                   APP_BEACON_UUID[2],APP_BEACON_UUID[3],APP_BEACON_UUID[4],APP_BEACON_UUID[5],APP_BEACON_UUID[6],\
                   APP_BEACON_UUID[7],APP_BEACON_UUID[8],APP_BEACON_UUID[9],APP_BEACON_UUID[10],APP_BEACON_UUID[11],\
                   APP_BEACON_UUID[12],APP_BEACON_UUID[13],APP_BEACON_UUID[14],APP_BEACON_UUID[15]);
  Serial.printf("%s\n",MY_UUID);


  pAdvertising->stop();
  //delay(5);
  setBeacon();
  //delay(5);
  //resetBeacon();
  pAdvertising->start();


  //portEXIT_CRITICAL_ISR(&timerMux);
  portEXIT_CRITICAL_ISR(&timerMux);
  xSemaphoreGiveFromISR(timerSemaphore, NULL);
}

void setBeacon() {
  BLEBeacon oBeacon = BLEBeacon();
  oBeacon.setManufacturerId(0x4C00); // fake Apple 0x004C LSB (ENDIAN_CHANGE_U16!)
  oBeacon.setProximityUUID(BLEUUID(MY_UUID));
  oBeacon.setMajor(123);
  oBeacon.setMinor(456);
  BLEAdvertisementData oAdvertisementData = BLEAdvertisementData();
  BLEAdvertisementData oScanResponseData = BLEAdvertisementData();
  
  oAdvertisementData.setFlags(0x04); // BR_EDR_NOT_SUPPORTED 0x04

  std::string strServiceData = "";

  strServiceData += (char)26;     // Len
  strServiceData += (char)0xFF;   // Type
  strServiceData += oBeacon.getData();
  oAdvertisementData.addData(strServiceData);

  pAdvertising->setAdvertisementData(oAdvertisementData);
  pAdvertising->setScanResponseData(oScanResponseData);
  

}

void timer1_init()
{
  timer = timerBegin(0, 80, true);
  timerAttachInterrupt(timer, &onTimer, true);
  timerAlarmWrite(timer, 1000000, true);
  timerAlarmEnable(timer);

}

void setup() {

  // Start the I2C interface


  Serial.begin(115200);
  //gettimeofday(&now, NULL);
  Wire.begin();

  Serial.printf("start ESP32\n");
  delay(10);
  
//  WiFi.begin(ssid,password);
//
//  while (WiFi.status() != WL_CONNECTED) {
//        delay(500);
//        Serial.print(".");
//  }
//  Serial.print("WIFI CONNECT!!!\n");


  timerSemaphore = xSemaphoreCreateBinary();


  // Create the BLE Device
  BLEDevice::init("Attendance Beacon");


  // Create the BLE Server
  BLEServer *pServer = BLEDevice::createServer();


  pAdvertising = pServer->getAdvertising();


  setBeacon();
  Serial.print("5\n");
  delay(1000);
  // Start advertising

  //pAdvertising->stop();
  //Serial.printf("enter deep sleep\n");
  //esp_deep_sleep(1000000LL * GPIO_DEEP_SLEEP_DURATION);
  //Serial.printf("in deep sleep\n");

  pAdvertising->start();
  Serial.println("Advertizing started...");
  delay(1000);

  WiFi.disconnect();
  WiFi.begin(ssid,password);
//
  while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
  }
  Serial.print("WIFI CONNECT!!!\n");
  delay(1000);
  
//
//  Serial.println("");
//  Serial.println("WiFi connected");
//  Serial.println("IP address: ");
//  Serial.println(WiFi.localIP());

  timer1_init();

}

void loop() {
  if (xSemaphoreTake(timerSemaphore, 0) == pdTRUE){

  if(interruptCounter){
    //Serial.println(ESP.getFreeHeap());
    now = RTC.now();
    portENTER_CRITICAL(&timerMux);
    interruptCounter = 0;
    portEXIT_CRITICAL(&timerMux);
    Serial.printf("IN MAINLOOP\n");
  }
  
  }


}
