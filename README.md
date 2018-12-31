## homify-hue - Hue Plug-in for homify
Control you Hue-Devices with homify

## Features
- Control you Hue Lamps

## Coming soon
- Discover function, to discover all Hue-Lamp in your local network (upnp-broadcast)


## Installation

1. Navigate into your homify folder
3. Run ```composer require markushaug/homify-phue``` 

## Usage

The following json is required for the plug-in, when you create a new thing:
- ```{"ip":"<bridge_ip>"}```

Homify's routing is fully dynamically. You can use the following URL to access your things:

- ```https://<server_ip>/thing/<thing_name>/<channel>```

## Channels
The following channels are available.

- ```on``` 
- ```off``` 
- ```output``` -> Status like 'ON' / 'OFF' / ...
- ```setBrightness```
- ```getBrightness```


