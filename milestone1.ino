// This #include statement was automatically added by the Particle IDE.
#include <carloop.h>

//carloop object
Carloop<CarloopRevision2> carloop;

// The TinyGPS++ object
TinyGPSPlus gps;

void setup() {
    carloop.begin();
    Serial.begin(9600);
}

void loop() {
    carloop.update();
    CANMessage message;
    if(carloop.can().receive(message)) {
        Serial.printlnf("ID %03x len %d", message.id, message.len);
        for(int i = 0; i < message.len; i++) {
            Serial.printf("%02x ", message.data[i]);
        }
    }
    
    Serial.printlnf("Has GPS: %d", carloop.hasGPS());
    
    float lat = carloop.gps().location.lat();
    float lng = carloop.gps().location.lng();
    bool gpsValid = carloop.gps().location.isValid();
    
    if (carloop.gps().location.isValid())
    {
        Serial.printlnf("valid: %d | lat: %f lng: %f", gpsValid, lat, lng);
    }
    else
    {
        Serial.println("INVALID GPS");
    }
    
    Serial.println("");
    delay(3000); //wait 3 seconds so results can be clearly analyzed
}