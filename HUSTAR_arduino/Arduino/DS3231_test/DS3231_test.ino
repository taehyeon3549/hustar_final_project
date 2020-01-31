/*
DS3231_test.pde
Eric Ayars
4/11

Test/demo of read routines for a DS3231 RTC.

Turn on the serial monitor after loading this to check if things are
working as they should.

*/

#include <DS3231.h>
#include <Wire.h>

DS3231 Clock;

bool Century=false;
bool h12;
bool PM;
byte ADay, AHour, AMinute, ASecond, ABits;
bool ADy, A12h, Apm;
uint8_t mYear,mMonth,mDay,mHour,mMinute,mSec;
uint8_t currentTime[8];

void setup() {
	// Start the I2C interface
	Wire.begin();
	// Start the serial interface
	Serial.begin(115200);
}

void loop() {
	// send what's going on to the serial monitor.
	// Start with the year
	Serial.print("2");
	Serial.print("0");
  mYear = Clock.getYear();
  mSec = Clock.getSecond();
  Serial.print(mYear,DEC);
  Serial.print(mSec,DEC);


	delay(1000);
}
