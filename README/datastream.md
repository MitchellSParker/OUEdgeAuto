# EdgeAuto-datastream
#### By Mitchell Parker

## Objective 
  The datastream handles the data collection from the carloop connected to the vehicle, all the way to the node. This will handle the direction of the output for the carloop to a specific node based on the carloop's GPS position. 

## Design Scheme
  The carloop performs a handshake with the mapping node with a TCP/IP connection. Once the mapping node receives the request, it creates a unique ID for the carloop and its current session. The carloop receives this information, then process to wait for the GPS module to begin data collection. After the GPS data has been ascertained, it is sent to the mapping server for evaluation. The mapping node will send back the IP address of the node the carloop should stream to. The connection is then ended and the carloop begins streaming data. 
  
  The regular nodes will receive data in the form of "arb_id,message,latitude,longitude,cantime,session_id;". This data will be picked up from the socket and will typically contain more than one message. The ";" delimiter will denote an entry message sent to the node, whereas the delimiter "," denotes the different values of a message. All of this is then stored into the mySQL database.
  
## Configuration
  The carloop should be pre-programmed to connect to the mapping node. On the node that will be hosting the mapping functionality, run `php mapping.php`. All of the regular nodes should run the script `php server.php`. The only modifications that need to be made to these sockets, are the `$host` and `$port` variables, which are dependent on your current situation. After these sockets are established, we can now run the carloop setup sequence.  

## Hardware
### Carloop basic
https://store.carloop.io/products/carloop-basic

Retrieves CAN messages through a vehicles OBD2 port.

### Carloop GPS
https://store.carloop.io/products/carloop-gps?variant=4846877966372

Obtains GPS coordinates of the carloop in real-time.

### Particle Photon
https://store.particle.io/products/photon

Allows code to be added to it through the Particle IDE. Photon code controls the gathering of the CAN message and GPS data.

## Software
https://build.particle.io
Particle IDE which is used to configure the Particle Photon.

https://www.jetbrains.com/phpstorm/
PhpStorm IDE is what was used to develop any other program such as the scripts.

## License

There is none. If for some unlikely reason you want to use anything here, you can do so without my permission. I grant thee the privilege.
