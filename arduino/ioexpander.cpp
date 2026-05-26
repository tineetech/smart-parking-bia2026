#include <Wire.h>
#include <PCF8574.h>

PCF8574 pcf(0x20);

void setup() {
  Serial.begin(115200);

  Wire.begin(23, 27);

  if (pcf.begin()) {
    Serial.println("PCF8574 Connected!");
  } else {
    Serial.println("PCF8574 NOT FOUND!");
  }

  // semua OFF
  pcf.write8(0x00);
}

void loop() {

  // =========================
  // TEST BUZZER P0 - P2
  // =========================
  for (int i = 0; i <= 2; i++) {

    Serial.print("Buzzer P");
    Serial.println(i);

    pcf.write(i, LOW);

    delay(1000);

    pcf.write(i, HIGH);

    delay(500);
  }

  // =========================
  // TEST LED P3 - P7
  // =========================
  for (int i = 3; i <= 7; i++) {

    Serial.print("LED P");
    Serial.println(i);

    pcf.write(i, HIGH);

    delay(2000);

    pcf.write(i, LOW);

    delay(200);
  }
}