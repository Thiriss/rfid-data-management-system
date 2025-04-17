import paho.mqtt.client as mqtt
import json
import time

# MQTT Broker details
broker = "202.44.44.233" 
port = 1883

topic_1 = "rfid/location"
# topic_2 = "rfid/location2"

# Callback function when a message is received
def on_message(client, userdata, message):
    payload = message.payload.decode("utf-8")  # Decode message
    print(f"\n📥 Received message from {message.topic}: {payload}")

# Create MQTT client
client = mqtt.Client()

# Set up callback for received messages
client.on_message = on_message

# Connect to MQTT broker
client.connect(broker, port, 60)

# Subscribe to the topics
client.subscribe(topic_1)
# client.subscribe(topic_2)

# Start the MQTT loop in a separate thread
client.loop_start()

# Sample Data to Publish
data_1 = {"rfid": "123456789", "location": "Room A"}
data_2 = {"rfid": "987654321", "location": "Room B"}
data_3 = {"rfid": "448658600", "location": "Room C"}


try:
    while True:
        # Publish to topics
        client.publish(topic_1, json.dumps(data_1))
        client.publish(topic_1, json.dumps(data_2))
        client.publish(topic_1, json.dumps(data_3))
        
        print(f"📤 Published to {topic_1}: {data_1}")
        print(f"📤 Published to {topic_1}: {data_2}")
        print(f"📤 Published to {topic_1}: {data_3}")

        
        time.sleep(30)  # Send every 30 seconds

except KeyboardInterrupt:
    print("\nDisconnecting...")
    client.loop_stop()
    client.disconnect()
