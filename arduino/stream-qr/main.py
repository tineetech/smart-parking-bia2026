import cv2

url = "http://10.154.81.163/stream"

cap = cv2.VideoCapture(url)

if not cap.isOpened():
    print("❌ Gagal buka stream")
    exit()

print("✅ Stream terbuka")

detector = cv2.QRCodeDetector()

while True:
    ret, frame = cap.read()

    if not ret:
        print("❌ Gagal ambil frame")
        break

    data, bbox, _ = detector.detectAndDecode(frame)

    if data:
        print("QR DETECTED:", data)

    cv2.imshow("ESP32 Stream", frame)

    if cv2.waitKey(1) == 27:
        break

cap.release()
cv2.destroyAllWindows()