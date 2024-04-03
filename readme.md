# Devices storage API

## Install with docker compose

1. Run docker-compose pull
2. Run docker-compose up

curl: add 2 devices, list result

```sh
curl http://localhost:8081/save -v -H "Authorization: devices-storage" -d '{"hostname":"test-hostname","device_type":"pc","os_type":"lin","owner_name":"test-user"}'

curl http://localhost:8081/save -v -H "Authorization: devices-storage" -d '{"hostname":"test-hostname2","device_type":"laptop","os_type":"win","owner_name":"user2"}'

curl http://localhost:8081/list -v -H "Authorization: devices-storage"
```

# End points

## Listing all devices

`http://localhost:8081/list`

```
METHOD: GET

HEADERS
Content-Type:application/json
Authorization:
```

## Adding new device

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

# How to run frontend

1. Go to `/frontend` directory

2. create new `.env` in the root project directory and populate VITE variables as described in `.env.example`

3. run `pnpm install` or similar command in other NodeJS package manager

4. run `pnpm run dev` or similar command in other NodeJS package manager
