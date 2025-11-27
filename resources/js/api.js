/**
 * API Client para integración Frontend-Backend
 * Utiliza axios para realizar peticiones HTTP a la API
 */

import axios from 'axios';

// Configuración base de axios
const API_BASE_URL = import.meta.env.VITE_API_URL || '/api';

// Crear instancia de axios con configuración base
const apiClient = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

// Interceptor para agregar token JWT a todas las peticiones
apiClient.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('access_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Interceptor para manejar errores de respuesta
apiClient.interceptors.response.use(
    (response) => response,
    async (error) => {
        const originalRequest = error.config;

        // Si el token expiró, intentar refrescarlo
        if (error.response?.status === 401 && error.response?.data?.error === 'token_expired' && !originalRequest._retry) {
            originalRequest._retry = true;

            try {
                const { data } = await apiClient.post('/auth/refresh');
                const newToken = data.data.access_token;
                localStorage.setItem('access_token', newToken);
                originalRequest.headers.Authorization = `Bearer ${newToken}`;
                return apiClient(originalRequest);
            } catch (refreshError) {
                // Si falla el refresh, redirigir al login
                localStorage.removeItem('access_token');
                window.location.href = '/login';
                return Promise.reject(refreshError);
            }
        }

        return Promise.reject(error);
    }
);

/**
 * Servicio de autenticación
 */
export const authService = {
    /**
     * Iniciar sesión
     * @param {Object} credentials - Email y password
     * @returns {Promise}
     */
    login: async (credentials) => {
        const { data } = await apiClient.post('/auth/login', credentials);
        if (data.success && data.data.access_token) {
            localStorage.setItem('access_token', data.data.access_token);
            localStorage.setItem('user', JSON.stringify(data.data.user));
        }
        return data;
    },

    /**
     * Registrar nuevo usuario
     * @param {Object} userData - Datos del usuario
     * @returns {Promise}
     */
    register: async (userData) => {
        const { data } = await apiClient.post('/auth/register', userData);
        if (data.success && data.data.access_token) {
            localStorage.setItem('access_token', data.data.access_token);
            localStorage.setItem('user', JSON.stringify(data.data.user));
        }
        return data;
    },

    /**
     * Cerrar sesión
     * @returns {Promise}
     */
    logout: async () => {
        try {
            await apiClient.post('/auth/logout');
        } finally {
            localStorage.removeItem('access_token');
            localStorage.removeItem('user');
        }
    },

    /**
     * Obtener usuario autenticado
     * @returns {Promise}
     */
    me: async () => {
        const { data } = await apiClient.get('/auth/me');
        if (data.success) {
            localStorage.setItem('user', JSON.stringify(data.data));
        }
        return data;
    },

    /**
     * Refrescar token
     * @returns {Promise}
     */
    refresh: async () => {
        const { data } = await apiClient.post('/auth/refresh');
        if (data.success && data.data.access_token) {
            localStorage.setItem('access_token', data.data.access_token);
        }
        return data;
    },

    /**
     * Verificar si el usuario está autenticado
     * @returns {boolean}
     */
    isAuthenticated: () => {
        return !!localStorage.getItem('access_token');
    },

    /**
     * Obtener usuario del localStorage
     * @returns {Object|null}
     */
    getUser: () => {
        const userStr = localStorage.getItem('user');
        return userStr ? JSON.parse(userStr) : null;
    }
};

/**
 * Servicio de productos
 */
export const productService = {
    /**
     * Obtener lista de productos con filtros
     * @param {Object} params - Parámetros de filtrado y paginación
     * @returns {Promise}
     */
    getAll: async (params = {}) => {
        const { data } = await apiClient.get('/products', { params });
        return data;
    },

    /**
     * Obtener un producto por ID
     * @param {number} id - ID del producto
     * @returns {Promise}
     */
    getById: async (id) => {
        const { data } = await apiClient.get(`/products/${id}`);
        return data;
    },

    /**
     * Crear nuevo producto
     * @param {Object} productData - Datos del producto
     * @returns {Promise}
     */
    create: async (productData) => {
        const { data } = await apiClient.post('/products', productData);
        return data;
    },

    /**
     * Actualizar producto existente
     * @param {number} id - ID del producto
     * @param {Object} productData - Datos actualizados
     * @returns {Promise}
     */
    update: async (id, productData) => {
        const { data } = await apiClient.put(`/products/${id}`, productData);
        return data;
    },

    /**
     * Eliminar producto
     * @param {number} id - ID del producto
     * @returns {Promise}
     */
    delete: async (id) => {
        const { data } = await apiClient.delete(`/products/${id}`);
        return data;
    }
};

/**
 * Servicio de categorías
 */
export const categoryService = {
    /**
     * Obtener lista de categorías
     * @param {Object} params - Parámetros de filtrado y paginación
     * @returns {Promise}
     */
    getAll: async (params = {}) => {
        const { data } = await apiClient.get('/categories', { params });
        return data;
    },

    /**
     * Obtener una categoría por ID
     * @param {number} id - ID de la categoría
     * @returns {Promise}
     */
    getById: async (id) => {
        const { data } = await apiClient.get(`/categories/${id}`);
        return data;
    },

    /**
     * Crear nueva categoría
     * @param {Object} categoryData - Datos de la categoría
     * @returns {Promise}
     */
    create: async (categoryData) => {
        const { data } = await apiClient.post('/categories', categoryData);
        return data;
    },

    /**
     * Actualizar categoría existente
     * @param {number} id - ID de la categoría
     * @param {Object} categoryData - Datos actualizados
     * @returns {Promise}
     */
    update: async (id, categoryData) => {
        const { data } = await apiClient.put(`/categories/${id}`, categoryData);
        return data;
    },

    /**
     * Eliminar categoría
     * @param {number} id - ID de la categoría
     * @returns {Promise}
     */
    delete: async (id) => {
        const { data } = await apiClient.delete(`/categories/${id}`);
        return data;
    }
};

/**
 * Utilidades para manejo de errores
 */
export const handleApiError = (error) => {
    if (error.response) {
        // El servidor respondió con un código de estado fuera del rango 2xx
        return {
            message: error.response.data.message || 'Error en la petición',
            errors: error.response.data.errors || null,
            status: error.response.status
        };
    } else if (error.request) {
        // La petición fue hecha pero no se recibió respuesta
        return {
            message: 'No se recibió respuesta del servidor',
            errors: null,
            status: null
        };
    } else {
        // Algo sucedió al configurar la petición
        return {
            message: error.message || 'Error desconocido',
            errors: null,
            status: null
        };
    }
};

export default apiClient;
