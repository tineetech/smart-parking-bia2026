import cv2
import requests
import time
import os
import json

import paho.mqtt.client as mqtt

from dotenv import load_dotenv

# =========================
# LOAD ENV
# =========================
load_dotenv()

STREAM_URL = os.getenv("STREAM_URL")
API_URL = os.getenv("API_URL")

MQTT_BROKER = os.getenv("MQTT_BROKER")
MQTT_PORT = int(os.getenv("MQTT_PORT", 1883))
MQTT_USERNAME = os.getenv("MQTT_USERNAME")
MQTT_PASSWORD = os.getenv("MQTT_PASSWORD")
MQTT_TOPIC = os.getenv("MQTT_TOPIC")

# =========================
# MQTT CONNECT
# =========================
# mqtt_client = mqtt.Client()
mqtt_client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)

# Login MQTT
mqtt_client.username_pw_set(
    MQTT_USERNAME,
    MQTT_PASSWORD
)

try:
    mqtt_client.socket_timeout = 20
    mqtt_client.connect(MQTT_BROKER, MQTT_PORT, keepalive=120)

    mqtt_client.loop_start()

    print("✅ MQTT CONNECTED")
    print(f"📡 BROKER : {MQTT_BROKER}:{MQTT_PORT}")
    print(f"👤 USER   : {MQTT_USERNAME}")
    print(f"📨 TOPIC  : {MQTT_TOPIC}")

except Exception as e:

    print(f"❌ MQTT ERROR : {e}")

    raise SystemExit(1)

print()

# =========================
# APP INFO
# =========================
print("=" * 50)
print("🚗 SMART PARKING QR SCANNER")
print("=" * 50)
print(f"📡 STREAM : {STREAM_URL}")
print(f"🌐 API    : {API_URL}")
print()

# =========================
# OPEN STREAM
# =========================
print("🔄 Membuka stream kamera...")

cap = cv2.VideoCapture(STREAM_URL)

if not cap.isOpened():
    print("❌ Gagal membuka stream")
    raise SystemExit(1)

print("✅ Stream berhasil dibuka")
print()

# =========================
# QR DETECTOR
# =========================
detector = cv2.QRCodeDetector()

# Anti spam
last_qr = None
last_time = 0
gate_is_open = False
gate_close_time = 0

print("📷 Scanner aktif")
print("❌ Tekan ESC untuk keluar")
print("=" * 50)

while True:

    ret, frame = cap.read()
    
    if gate_is_open and time.time() >= gate_close_time:

        print("🚪 Menutup portal masuk...")

        mqtt_client.publish(
            MQTT_TOPIC,
            json.dumps({"status": "close"})
        )

        print("📨 MQTT SENT")
        print(f"📡 TOPIC : {MQTT_TOPIC}")

        gate_is_open = False

    if not ret:
        print("⚠️ Stream terputus")
        break

    data, bbox, _ = detector.detectAndDecode(frame)

    if data:

        current_time = time.time()

        # Anti spam request
        if data != last_qr or (current_time - last_time > 3):

            print()
            print("📦 QR TERDETEKSI")
            print(f"🔑 KODE : {data}")

            try:

                endpoint = f"{API_URL}/pemesanan/cek-kode/{data}"

                print("🌐 Request API...")
                print(f"➡️ {endpoint}")

                response = requests.get(endpoint, timeout=30)

                print(f"📥 STATUS : {response.status_code}")

                try:

                    result = response.json()

                    if response.status_code == 200:

                        print("✅ VALID")
                        print("🚪 Membuka portal masuk...")

                        # =========================
                        # MQTT PUBLISH
                        # =========================
                        payload = {
                            "status": "open"
                        }

                        mqtt_client.publish(
                            MQTT_TOPIC,
                            json.dumps(payload)
                        )

                        payloadBuzzer = {
                            "buzzer": "on"
                        }

                        mqtt_client.publish(
                            MQTT_TOPIC,
                            json.dumps(payloadBuzzer)
                        )

                        print("📨 MQTT SENT")
                        print(f"📡 TOPIC : {MQTT_TOPIC}")
                        print(f"📄 DATA  : {payload}")
                        print(f"📄 DATA 2 : {payloadBuzzer}")
                        
                        gate_is_open = True
                        gate_close_time = time.time() + 3

                    else:

                        print("❌ TIDAK VALID")
                        print("📄 RESPONSE:")
                        print(result)

                except Exception as e:
                    print(f"❌ JSON ERROR : {e}")

            except Exception as e:
                print(f"❌ ERROR API : {e}")

            last_qr = data
            last_time = current_time

    cv2.imshow("ESP32 Stream", frame)

    # ESC
    if cv2.waitKey(1) == 27:
        print()
        print("🛑 Scanner dihentikan")
        break

cap.release()
cv2.destroyAllWindows()
mqtt_client.loop_stop()
mqtt_client.disconnect()