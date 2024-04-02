import axios, { AxiosInstance } from 'axios';

export const axiosInstance: AxiosInstance = axios.create({
  headers: {
    'Content-Type': 'application/json',
    Authorization: import.meta.env.VITE_API_KEY,
  },
  baseURL: import.meta.env.VITE_API_BASE_URL,
});
