import threading
import time
import json
import paho.mqtt.client as mqtt
from sllurp.llrp import LLRP_DEFAULT_PORT, LLRPReaderConfig, LLRPReaderClient

# MQTT Broker Configuration
broker = "202.44.44.233"
port = 1883
topic_1 = "rfid/ig"  # Main topic to publish data to
topic_2 = "rfid/changingroom"  # Additional topic for antenna 2 (Room B)

class ImpinjReader:
    def __init__(self, host, port=LLRP_DEFAULT_PORT):
        self.host = host
        self.port = port
        self.reader = None
        self.mqtt_client = None
        self.running = False
        self.current_antenna = 1  # Start with antenna 1
        self.tx_power = 33  # Transmission power in dBm

    def setup_mqtt(self):
        """Set up the MQTT client."""
        self.mqtt_client = mqtt.Client()
        self.mqtt_client.connect(broker, port, 60)
        self.mqtt_client.loop_start()

    def antenna_to_room(self, antenna_id):
        """Map antenna number to corresponding room name."""
        return {
            1: "Room A",
            2: "Room B"
        }.get(antenna_id, "Unknown Room")

    def tag_seen_callback(self, reader, tags):
        """Callback function when RFID tags are detected."""
        for tag in tags:
            epc_bytes = tag.get('EPC-96', b'')
            epc = epc_bytes.decode() if epc_bytes else "UNKNOWN"
            antenna = tag.get('AntennaID', tag.get('ChannelIndex', 'N/A'))
            room = self.antenna_to_room(antenna)

            # Prepare the data
            tag_data = {
                "tag_id": epc,
                "location": room
            }

            json_data = json.dumps(tag_data)

            # Publish to the main topic
            self.mqtt_client.publish(topic_1, json_data)
            print(f"Published from antenna {antenna} to {topic_1}: {json_data}")

            # Publish to topic_2 if antenna 2 is used
            if antenna == 2:
                print(f"Publishing to additional topic '{topic_2}': {json_data}")
                self.mqtt_client.publish(topic_2, json_data)

    def finish_cb(self, reader):
        """Callback when reading finishes."""
        print("Reading finished.")

    def start_reading(self):
        """Start the RFID reader and begin reading tags at intervals."""
        self.running = True
        threading.Thread(target=self.cycle_antennas, daemon=True).start()

    def cycle_antennas(self):
        """Cycle between antennas 1 and 2 every 2 seconds."""
        while self.running:
            self.configure_reader(self.current_antenna)  # Configure the reader with the current antenna
            time.sleep(1)  # 2-second delay before switching to the other antenna
            # Switch between antenna 1 and 2
            self.current_antenna = 2 if self.current_antenna == 1 else 1

    def configure_reader(self, antenna_id):
        """Configure the reader with the selected antenna."""
        if self.reader:
            try:
                self.reader.disconnect()  # Disconnect the previous reader connection
            except Exception as e:
                print(f"Error disconnecting: {e}")

        # Set the configuration for the RFID reader
        factory_args = {
            'report_every_n_tags': 1,
            'antennas': [antenna_id],  # Use the current antenna
            'tx_power': self.tx_power,
            'start_inventory': True,
            'disconnect_when_done': False,
            'tag_content_selector': {
                'EnableROSpecID': True,
                'EnableSpecIndex': True,
                'EnableInventoryParameterSpecID': True,
                'EnableAntennaID': True,
                'EnableChannelIndex': True,
                'EnablePeakRSSI': True,
                'EnableFirstSeenTimestamp': True,
                'EnableLastSeenTimestamp': True,
                'EnableTagSeenCount': True,
                'EnableAccessSpecID': True,
                'C1G2EPCMemorySelector': {
                    'EnableCRC': True,
                    'EnablePCBits': True,
                }
            }
        }

        # Create the reader configuration and client
        config = LLRPReaderConfig(factory_args)
        self.reader = LLRPReaderClient(self.host, self.port, config)
        self.reader.add_tag_report_callback(self.tag_seen_callback)
        self.reader.add_disconnected_callback(self.finish_cb)

        try:
            print(f"Connecting to reader at {self.host}:{self.port} using antenna {antenna_id}...")
            self.reader.connect()  # Connect to the reader using the selected antenna
        except Exception as e:
            print(f"Error connecting to reader: {e}")

    def stop_reading(self):
        """Stop the RFID reader and disconnect."""
        self.running = False
        if self.reader:
            try:
                print("Disconnecting from reader...")
                self.reader.disconnect()
            except Exception as e:
                print(f"Error disconnecting: {e}")
        if self.mqtt_client:
            self.mqtt_client.loop_stop()

def main():
    host = "169.254.1.1"  # Replace with your reader's IP address
    reader = ImpinjReader(host)
    reader.setup_mqtt()
    reader.start_reading()

    try:
        while True:
            time.sleep(1)  # Keep the program running
    except KeyboardInterrupt:
        reader.stop_reading()
        print("Program stopped.")

if __name__ == "__main__":
    main()
