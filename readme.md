Devices storage API
===================


Install with docker compose
------------
1. Run docker-compose pull
2. Run docker-compose up


curl:

curl http://localhost:8081/save -v -H "Authorization: devices-storage" -d '{"hostname":"test-hostname","device_type":"pc","os_type":"lin","owner_name":"test-user"}'

curl http://localhost:8081/save -v -H "Authorization: devices-storage" -d '{"hostname":"test-hostname2","device_type":"laptop","os_type":"win","owner_name":"user2"}'

curl http://localhost:8081/list -v -H "Authorization: devices-storage"


End points
=================

Listing all devices
------------
`http://localhost:8081/list`
```
METHOD: GET

HEADERS
Content-Type:application/json
Authorization:
```


Adding new device
------------
`http://localhost:8081/save`

```
METHOD: POST

HEADERS
Content-Type:application/json
Authorization:
{

    hostname: this.hostname,
    device_type: this.device,
    os_type: this.os,
    owner_name: this.owner

}
```
