#include <Wire.h>
#include "KISA_HIGHT_CBC.h"
#include "DS3231.h"
//DS3231 Clock;
RTClib RTC;
DateTime now;

uint8_t APP_BEACON_UUID[] = {0x8e,0xc7,0x6e,0xa3,\
                          0xf0,0xf0,0xf0,0xf0,\
                          0xf0,0xf0,0xf0,0xf0,\
                          0x03,0x03,0x03,0x94};

uint8_t pbszUserKey[16] = {0x88, 0xe3, 0x4f, 0x8f, 0x08, 0x17, 0x79, 0xf1, 0xe9, 0xf3, 0x94, 0x37, 0x0a, 0xd4, 0x05, 0x89}; 
uint8_t pbszIV[8] = {0x26, 0x8d, 0x66, 0xa7, 0x35, 0xa8, 0x1a, 0x81};

uint8_t pbszCipherText[10] = {0x00};
uint8_t plainText[6] = {0x8e,0xc7,0x6e,0xa3,\
                        0xf0,0xf0};
uint8_t nPlainTextLen = 6;
uint8_t nCipherTextLen;

//char BEACON_UUID[] = "8ec76ea3-6668-48da-9866-75be03030394";
char UUID_BUF[256] = {0x00,};


void setup() {

  // put your setup code here, to run once:
  Serial.begin(115200);
  Wire.begin();

}

void loop() {
  // put your main code here, to run repeatedly:
  now = RTC.now();
  //plainText[0] = Clock.getSecond();
  plainText[0] = now.second();
  plainText[1] = now.minute();
  plainText[2] = now.hour();
  plainText[3] = now.day();
  plainText[4] = now.month();
  plainText[5] = now.year();

  
  nCipherTextLen = HIGHT_CBC_Encrypt(pbszUserKey,pbszIV,plainText,0,6,pbszCipherText);


  for(int i = 0;i < 8;i++)
  {
    APP_BEACON_UUID[i] = pbszCipherText[i];
  }

  sprintf(UUID_BUF,"%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x-%02x%02x%02x%02x%02x%02x",APP_BEACON_UUID[0],APP_BEACON_UUID[1],APP_BEACON_UUID[2],APP_BEACON_UUID[3],\
                                                APP_BEACON_UUID[4],APP_BEACON_UUID[5],APP_BEACON_UUID[6],APP_BEACON_UUID[7],\
                                                APP_BEACON_UUID[8],APP_BEACON_UUID[9],APP_BEACON_UUID[10],APP_BEACON_UUID[11],\
                                                APP_BEACON_UUID[12],APP_BEACON_UUID[13],APP_BEACON_UUID[14],APP_BEACON_UUID[15]);

  printf("%s \n",UUID_BUF);
  

  delay(1000);

}
