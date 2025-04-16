import paho.mqtt.client as mqtt
import json

# MQTT Broker details
broker = "202.44.44.233"
port = 1883
topic = "rfid/location"

# Callback for received messages (optional)
def on_message(client, userdata, message):
    payload = message.payload.decode("utf-8")
    print(f"📥 Received on {message.topic}: {payload}")

# MQTT client setup
client = mqtt.Client()
client.on_message = on_message
client.connect(broker, port, 60)
client.loop_start()

print("🚀 Ready to send RFID data. Press Ctrl+C to stop.")

try:
    while True:
        rfid = input("Enter RFID: ")
        location = input("Enter Location: ")
        
        data = {
            "rfid": rfid,
            "location": location
        }

        client.publish(topic, json.dumps(data))
        print(f"📤 Published to {topic}: {data}\n")

except KeyboardInterrupt:
    print("\n👋 Disconnecting...")
    client.loop_stop()
    client.disconnect()
