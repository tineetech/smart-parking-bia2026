#include <WiFi.h>
#include "esp_camera.h"
#include <WebServer.h>

// ================= WIFI =================
const char* ssid = "b";
const char* password = "88888888";

// ================= CAMERA CONFIG (AI THINKER) =================
#define PWDN_GPIO_NUM     32
#define RESET_GPIO_NUM    -1
#define XCLK_GPIO_NUM      0
#define SIOD_GPIO_NUM     26
#define SIOC_GPIO_NUM     27

#define Y9_GPIO_NUM       35
#define Y8_GPIO_NUM       34
#define Y7_GPIO_NUM       39
#define Y6_GPIO_NUM       36
#define Y5_GPIO_NUM       21
#define Y4_GPIO_NUM       19
#define Y3_GPIO_NUM       18
#define Y2_GPIO_NUM        5
#define VSYNC_GPIO_NUM    25
#define HREF_GPIO_NUM     23
#define PCLK_GPIO_NUM     22

WebServer server(80);

// ================= STREAM =================
void handle_jpg_stream(void) {
  WiFiClient client = server.client();

  String response = "HTTP/1.1 200 OK\r\n";
  response += "Content-Type: multipart/x-mixed-replace; boundary=frame\r\n\r\n";
  server.sendContent(response);

  while (client.connected()) {

    camera_fb_t * fb = esp_camera_fb_get();
    if (!fb) {
      Serial.println("Camera capture failed");
      continue;
    }

    server.sendContent("--frame\r\n");
    server.sendContent("Content-Type: image/jpeg\r\n\r\n");

    client.write(fb->buf, fb->len);  // 🔥 lebih stabil dari sendContent

    server.sendContent("\r\n");

    esp_camera_fb_return(fb);

    // 🔥 WAJIB: throttle FPS biar ESP32 nggak mati
    delay(50);  // coba 30–100 (50 paling stabil)

    if (!client.connected()) {
      Serial.println("Client disconnected");
      break;
    }
  }
}

// ================= SETUP =================
void setup() {
  Serial.begin(115200);

  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sscb_sda = SIOD_GPIO_NUM;
  config.pin_sscb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 20000000;
  config.pixel_format = PIXFORMAT_JPEG;

  // ================= 🔥 OPTIMASI PENTING =================
  config.frame_size = FRAMESIZE_QVGA;   // jangan QQVGA (QR susah kebaca)
  config.jpeg_quality = 25;             // makin besar = makin ringan
  config.fb_count = 1;                  // biar hemat RAM & stabil
  // ======================================================

  if (esp_camera_init(&config) != ESP_OK) {
    Serial.println("Camera init failed");
    return;
  }

  // 🔥 tambahan stabilitas sensor
  sensor_t * s = esp_camera_sensor_get();
  s->set_brightness(s, 1);
  s->set_contrast(s, 1);
  s->set_saturation(s, 0);

  // ================= WIFI =================
  WiFi.begin(ssid, password);
  Serial.print("Connecting WiFi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi Connected");
  Serial.print("Stream URL: http://");
  Serial.print(WiFi.localIP());
  Serial.println("/stream");

  // ================= WEB =================
  server.on("/", []() {
    server.send(200, "text/html",
      "<h1>ESP32-CAM</h1><img src='/stream'>");
  });

  server.on("/stream", HTTP_GET, handle_jpg_stream);

  server.begin();
}

// ================= LOOP =================
void loop() {
  server.handleClient();
}