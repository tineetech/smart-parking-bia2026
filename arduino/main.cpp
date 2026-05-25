#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>
#include <NewPing.h>
#include <ESP32Servo.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <PCF8574.h>

// =======================
// KONFIGURASI WIFI
// =======================
const char* ssid = "z";
const char* password = "00000000";

// =======================
// KONFIGURASI MQTT
// =======================
const char* mqtt_server = "187.77.115.222";
const int mqtt_port = 1883;
const char* mqtt_user = "user1";
const char* mqtt_pass = "chris00X";
const char* mqtt_client_id = "ESP32_SmartParking_01";

// Topic
// const char* topic_pub = "parking/data";
const char* topic_base = "parking/data/";
const char* topic_base_led = "parking/led/";
const char* topic_gate_in  = "parking/gate/in";
const char* topic_gate_out = "parking/gate/out";

// =======================
WiFiClient espClient;
PubSubClient client(espClient);

// =======================
// IO EXPANDER INITIAL
// =======================
PCF8574 pcf(0x20);

// =======================
// LCD ONE WIRE
// =======================
LiquidCrystal_I2C lcdIn(0x27, 16, 2);
LiquidCrystal_I2C lcdOut(0x26, 16, 2);

String runningText = "- Parkify Smart Parking System - ";
int scrollPos = 0;
unsigned long lastScroll = 0;

int totalSlot = 5;

int slotTersedia = 0;
int slotTerisi = 0;

// state LCD
int lcdState = 0;
unsigned long lastLCDUpdate = 0;
const int lcdInterval = 4000; // 4 detik (bisa ubah)


// =======================
// ULTRASONIC (NewPing)
// =======================
#define TOTAL_SENSOR 6
#define MAX_DISTANCE 300 // cm

NewPing sonar[TOTAL_SENSOR] = {
  NewPing(4, 34, MAX_DISTANCE),
  NewPing(5, 35, MAX_DISTANCE),
  NewPing(18, 32, MAX_DISTANCE),
  NewPing(19, 33, MAX_DISTANCE),
  NewPing(21, 25, MAX_DISTANCE),
  NewPing(22, 26, MAX_DISTANCE)
};

int slotStatus[TOTAL_SENSOR];
int lastSlotStatus[TOTAL_SENSOR];

const int threshold = 10;

// =======================
// SERVO INIT PIN
// =======================
Servo servoIn;
Servo servoOut;

#define SERVO_IN_PIN 13
#define SERVO_OUT_PIN 12

int posOpen = 130;
int posClose = 35;
int posOutOpen = 90;
int posOutClose = 180;

// =======================
// WIFI
// =======================
void connectWiFi() {
  Serial.print("Connecting to WiFi...");
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi Connected!");
}

// =======================
// SERVO FUNCTION
// =======================
void openGateIn() {
  Serial.println("Gate IN OPEN");
  servoIn.write(posOpen);
}

void closeGateIn() {
  Serial.println("Gate IN CLOSE");
  servoIn.write(posClose);
}

void openGateOut() {
  Serial.println("Gate OUT OPEN");
  servoOut.write(posOutOpen);
}

void closeGateOut() {
  Serial.println("Gate OUT CLOSE");
  servoOut.write(posOutClose);
}

// =======================
// MQTT CALLBACK (JSON PARSE)
// =======================
void mqttCallback(char* topic, byte* payload, unsigned int length) {
  Serial.print("Message received [");
  Serial.print(topic);
  Serial.println("]");

  StaticJsonDocument<256> doc;
  DeserializationError error = deserializeJson(doc, payload, length);

  if (error) {
    Serial.print("JSON Parse Failed: ");
    Serial.println(error.c_str());
    return;
  }

  const char* status = doc["status"];
  const char* buzzer = doc["buzzer"];

  Serial.print("Status: ");
  Serial.println(status);

  // =======================
  // GATE IN
  // =======================
  if (String(topic) == topic_gate_in) {
    if (String(status) == "open") {
      openGateIn();
    } else if (String(status) == "close") {
      closeGateIn();
    } else if (String(buzzer) == "on") {
      pcf.write(1, LOW);
      delay(300);
      pcf.write(1, HIGH);
    }
  }

  // =======================
  // GATE OUT
  // =======================
  if (String(topic) == topic_gate_out) {
    if (String(status) == "open") {
      openGateOut();
    } else if (String(status) == "close") {
      closeGateOut();
    } else if (String(buzzer) == "on") {
      pcf.write(2, LOW);
      delay(300);
      pcf.write(2, HIGH);
    }
  }

  // =======================
  // LED SLOT PARKIR
  // =======================
  
  // for (int i = 0; i < 5; i++) {
  //   if (String(topic) == topic_base_led + ) {
  //     if (String(status) == "open") {
  //       openGateOut();
  //     } else if (String(status) == "close") {
  //       closeGateOut();
  //     } else if (String(buzzer) == "on") {
  //       pcf.write(1, LOW);
  //       delay(500);
  //       pcf.write(1, HIGH);
  //     }
  //   }
  // }
}

// =======================
void initMQTT() {
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(mqttCallback);
  
  digitalWrite(2, HIGH);
}

// =======================
void reconnectMQTT() {
  while (!client.connected()) {
    Serial.print("Connecting to MQTT...");

    if (client.connect(mqtt_client_id, mqtt_user, mqtt_pass)) {
      Serial.println("Connected!");
      client.subscribe(topic_gate_in);
      client.subscribe(topic_gate_out);

    } else {
      Serial.print("Failed, rc=");
      Serial.println(client.state());
      delay(3000);
    }
  }
}


// =======================
// READ SENSOR + LOG
// =======================
void readSensors() {
  Serial.println("=== SENSOR READ ===");

  for (int i = 0; i < TOTAL_SENSOR; i++) {
    delay(30); // hindari interferensi
    // delay(120);

    int distance = sonar[i].ping_cm();

    // jika 0 berarti out of range → anggap kosong
    if (distance == 0) distance = 999;

    if (distance < threshold) {
      slotStatus[i] = 1;
    } else {
      slotStatus[i] = 0;
    }

    Serial.print("S");
    Serial.print(i + 1);
    Serial.print(": ");
    Serial.print(distance);
    Serial.print(" cm -> ");
    Serial.println(slotStatus[i]);
  }

  Serial.println("--------------------");
}

// =======================
// CEK PERUBAHAN
// =======================
bool isChanged() {
  for (int i = 0; i < TOTAL_SENSOR; i++) {
    if (slotStatus[i] != lastSlotStatus[i]) {
      return true;
    }
  }
  return false;
}

// =======================
// SIMPAN STATE TERAKHIR
// =======================
void saveState() {
  for (int i = 0; i < TOTAL_SENSOR; i++) {
    lastSlotStatus[i] = slotStatus[i];
  }
}

// =======================
// PUBLISH MQTT
// =======================
void publishData() {
  for (int i = 0; i < TOTAL_SENSOR; i++) {

    // buat topic dinamis: parking/data/1 dst
    String topic = String(topic_base) + String(i + 1);

    StaticJsonDocument<64> doc;
    doc["status"] = slotStatus[i];

    char buffer[64];
    serializeJson(doc, buffer);

    client.publish(topic.c_str(), buffer);

    Serial.print("MQTT Publish !");
    // Serial.print(topic);
    // Serial.print("]: ");
    // Serial.println(buffer);
  }
}

// =======================
// LCD LOGIC
// =======================
void calculateSlot() {
  slotTerisi = 0;

  for (int i = 0; i < TOTAL_SENSOR; i++) {
    if (slotStatus[i] == 1) {
      slotTerisi++;
    }
  }

  slotTersedia = totalSlot - slotTerisi;
}
void printCenter(LiquidCrystal_I2C &lcd, String text, int row) {
  int len = text.length();
  int col = (16 - len) / 2;

  if (col < 0) col = 0;

  lcd.setCursor(col, row);
  lcd.print(text);
}


void updateLCDIn() {
  lcdIn.clear();

  if (lcdState == 0) {
    printCenter(lcdIn, "PARKIFY", 0);
    printCenter(lcdIn, "Smart Parking", 1);
  }

  else if (lcdState == 1) {
    printCenter(lcdIn, "PARKIFY", 0);
    printCenter(lcdIn, "TOTAL SLOT: " + String(totalSlot), 1);
  }

  else if (lcdState == 2) {
    printCenter(lcdIn, "TERSEDIA: " + String(slotTersedia), 0);
    printCenter(lcdIn, "TERISI: " + String(slotTerisi), 1);
  }
}
void updateLCDOut() {
  lcdOut.clear();
  printCenter(lcdOut, "MOHON SIAPKAN", 0);
  printCenter(lcdOut, "QR TIEKT PARKIR", 1);
}


// =======================
// SETUP
// =======================
void setup() {
  Serial.begin(115200);
  Wire.begin(23, 27); // SDA, SCL sesuai wiring kamu

  pinMode(2, OUTPUT);
  digitalWrite(2, LOW);
  
  // initial io expander setup
  if (pcf.begin()) {
    Serial.println("PCF8574 Connected!");
  } else {
    Serial.println("PCF8574 NOT FOUND!");
  }
  
  pcf.write8(0xFF);
  
  // for (int i = 0; i <= 2; i++) {
  //   Serial.print("Buzzer initial set to OFF");
  //   pcf.write(i, HIGH);
  // }

  delay(500);
  pcf.write(0, LOW);
  lcdIn.init();
  lcdIn.backlight();

  lcdOut.init();
  lcdOut.backlight();

  servoIn.attach(SERVO_IN_PIN);
  servoOut.attach(SERVO_OUT_PIN);

  // posisi awal (tutup)
  servoIn.write(posClose);
  servoOut.write(posOutClose);
  
  updateLCDIn();
  updateLCDOut();
  
  pcf.write(0, HIGH);
  delay(1000);
  
  pcf.write(0, LOW);
  delay(100);
  pcf.write(0, HIGH);
  delay(100);
  pcf.write(0, LOW);
  delay(100);
  pcf.write(0, HIGH);
  connectWiFi();
  initMQTT();
  pcf.write(0, LOW);
  delay(300);
  pcf.write(0, HIGH);

  // init state awal
  for (int i = 0; i < TOTAL_SENSOR; i++) {
    slotStatus[i] = 0;
    lastSlotStatus[i] = -1; // supaya publish pertama kali
  }
}

// =======================
// LOOP
// =======================
void loop() {
  if (!client.connected()) {
    reconnectMQTT();
  }

  client.loop();

  static unsigned long lastRead = 0;

  // millis untuk update LCD tiap interval
  if (millis() - lastLCDUpdate > lcdInterval) {
    lastLCDUpdate = millis();

    calculateSlot(); // update data slot

    lcdState++;
    if (lcdState > 2) lcdState = 0;

    updateLCDIn();
  }

  // millis untuk baca dan kirim data sensor ke mqtt
  if (millis() - lastRead > 500) {
    lastRead = millis();

    readSensors(); // tetap print ke serial

    if (isChanged()) {
      Serial.println("STATUS BERUBAH → PUBLISH");
      publishData();
      saveState();
    } else {
      Serial.println("Tidak ada perubahan");
    }
  }
}