import paho.mqtt.client as mqtt
import json
import time
import random

# MQTT Broker details
broker = "202.44.44.233"
port = 1883
topic = "rfid/location"

# Callback function when a message is received
def on_message(client, userdata, message):
    payload = message.payload.decode("utf-8")
    print(f"\n📥 Received message from {message.topic}: {payload}")

# Create MQTT client
client = mqtt.Client()
client.on_message = on_message

# Connect to MQTT broker
client.connect(broker, port, 60)
client.subscribe(topic)
client.loop_start()

# Predefined list of locations
locations = ["Room A", "Room B", "Room C", "Room D", "Room E"]

rfid_counter = 1  # Start RFID ID from 1

try:
    while True:
        # Generate random location and increment RFID ID
        random_location = random.choice(locations)
        data = {
            "tag_id": str(rfid_counter),
            "location": random_location
        }

        # Publish to topic
        client.publish(topic, json.dumps(data))
        print(f"📤 Published to {topic}: {data}")

        rfid_counter += 1  # Increment RFID
        time.sleep(10)  # Delay between messages

except KeyboardInterrupt:
    print("\nDisconnecting...")
    client.loop_stop()
    client.disconnect()
