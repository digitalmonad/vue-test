import { axiosInstance } from '@/config/axios';
import {
  DeviceListApiResponse,
  mapDeviceListApiDataToDeviceSchemaShape,
} from '@/lib/types/deviceStorage';

export const getDeviceList = async () => {
  const response = await axiosInstance.get<DeviceListApiResponse>(`/list`);
  return response.data.map(mapDeviceListApiDataToDeviceSchemaShape);
};

export const createDevice = async (args) => {
  const response = await axiosInstance.post(`/save`, args);
  return response;
};
