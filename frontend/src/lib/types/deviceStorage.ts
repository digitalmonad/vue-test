import * as z from 'zod';

/**
 * Schemas
 */
const DeviceTypeSchema = z.enum(['pc', 'laptop', 'mobile']);

const OsTypeSchema = z.enum(['win', 'lin', 'macOS', 'iOS', 'android']);

export const DeviceSchema = z.object({
  hostName: z.string(),
  deviceType: DeviceTypeSchema,
  osType: OsTypeSchema,
  ownerName: z.string(),
});

export type Device = z.infer<typeof DeviceSchema>;

/**
 * API
 */
export type DeviceListApiResponse = {
  hostname: string;
  device_type: string;
  os_type: string;
  owner: string;
}[];

export const mapDeviceListApiDataToDeviceSchemaShape = (
  apiData: DeviceListApiResponse[number]
): Device => {
  return {
    hostName: apiData.hostname,
    deviceType: apiData.device_type as Device['deviceType'],
    osType: apiData.os_type as Device['osType'],
    ownerName: apiData.owner,
  };
};
