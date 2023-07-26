import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL;

const api = axios.create({
  baseURL: API_URL,
});

export const fetchUsers = async () => {
    const response = await api.get("users");
    return response.data;
};

export const fetchUserWeather = async (userId: number) => {
  const response = await api.get(`users/${userId}/weather`);
  return response.data;
};

export default api;
