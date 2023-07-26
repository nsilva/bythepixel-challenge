import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL;

const api = axios.create({
  baseURL: API_URL,
});

export const fetchUsers = async () => {
  try {
    const response = await api.get("users");
    return response.data;
  } catch (error) {
    console.log(error);
    return [];
  }
};

export const fetchUserWeather = async (userId: number) => {
  try {
    const response = await api.get(`users/${userId}/weather`);
    return response.data;
  } catch (error) {
    console.log(error);
    return [];
  }
};

export default api;
