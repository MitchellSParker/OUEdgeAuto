# EdgeAuto-carloop
#### By Chad Brown

## Objective
A full functional component that supports CAN message and GPS data collection from a Car via Carloop and its associated GPS components.

## Design Scheme
Collect data within the Particle Photon from the Carloop GPS and the Carloop Basic. The Carloop is attached to the OBD2 port of a vehicle. This data is printed to verify that credible data is being collected.

## Hardware
### Carloop basic
&nbsp;&nbsp;&nbsp;*https://store.carloop.io/products/carloop-basic*

Retrieves CAN messages through a vehicles OBD2 port.

### Carloop GPS
&nbsp;&nbsp;&nbsp;*https://store.carloop.io/products/carloop-gps?variant=4846877966372*

Obtains GPS coordinates of the carloop in real-time.

### Particle Photon
&nbsp;&nbsp;&nbsp;*https://store.particle.io/products/photon*

Allows code to be added to it through the Particle IDE. Photon code controls gathering the CAN message and GPS data.

## Software
### Particle IDE
&nbsp;&nbsp;&nbsp;*https://build.particle.io*

IDE that uses c++ to add functionality to the Particle Photon and associated components.			

## Configuration

Setup the Particle Photon Device: *https://docs.particle.io/quickstart/photon/)*

Enter the Particle Web IDE: *https://build.particle.io/build*

Create a new app and add the Carloop library to it: *https://github.com/carloop/carloop-library*

`#include <carloop.h>`

Initialize Carloop library objects (Carloop & TinyGPSPlus): *https://docs.particle.io/reference/device-os/firmware/photon/*

```C++
Carloop<CarloopRevision2> carloop;
TinyGPSPlus gps;
```

Use object functions (.gps() and .can()) and the the CANMessage object to retrieve CAN and GPS information.

```C++
//Check if GPS data is valid
bool gpsValid = carloop.gps().location.isValid();

//if GPS data is valid, retrieve GPS and CAN message data
if (gpsValid) {
        float lat = carloop.gps().location.lat();
        float lng = carloop.gps().location.lng();
        Serial.printlnf("%f, %f", lat, lng);
        
        CANMessage message; 
        if (carloop.can().receive(message)) {
                Serial.printlnf("%03x, %d", message.id, message.len);
                for (int i = 0; i < message.len; i++) {
                      Serial.printf("%02x ", message.data[i]);
                }
        }
        Serial.println("");
...
}
```

## Dependencies

Particle IDE Carloop Library: *https://github.com/carloop/carloop-library*

## License

There is none. If for some unlikely reason you want to use anything here, you can do so without my permission. I grant thee the privilege.
