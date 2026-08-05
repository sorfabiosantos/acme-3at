export default class HttpClientBase {
    #baseUrl;
    #defaultHeaders;

    constructor(baseUrl = "http://localhost:8080/acme-3am/api") {
        this.#baseUrl = baseUrl;
        this.#defaultHeaders = {
            "Content-Type": "application/json"
        };
    }

    setAuthToken(token) {
        this.#defaultHeaders["Authorization"] = `Bearer ${token}`;
    }

    clearAuthToken() {
        delete this.#defaultHeaders["Authorization"];
    }

    #buildUrl(endpoint, params = {}) {
        let url = `${this.#baseUrl}${endpoint}`;

        const queryParams = new URLSearchParams();
        for (const [key, value] of Object.entries(params)) {
            if (url.includes(`/:${key}`)) {
                url = url.replace(`:${key}`, value);
            } else {
                queryParams.append(key, value);
            }
        }

        const queryString = queryParams.toString();
        if (queryString) {
            url += `?${queryString}`;
        }

        return url;
    }

    async #fetchWithConfig(endpoint, config, params = {}) {
        const { _isFormData, ...fetchConfig } = config;

        try {
            const url = this.#buildUrl(endpoint, params);

            const headers = { ...this.#defaultHeaders, ...fetchConfig.headers };
            if (_isFormData) {
                delete headers["Content-Type"];
            }

            const response = await fetch(url, {
                ...fetchConfig,
                headers
            });

            const contentType = response.headers.get("content-type");
            if (contentType && contentType.includes("application/json")) {
                return await response.json();
            }

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.text();
        } catch (error) {
            throw new Error(`Request failed: ${error.message}`);
        }
    }

    async get(endpoint, params = {}, headers = {}) {
        return this.#fetchWithConfig(endpoint, {
            method: "GET",
            headers
        }, params);
    }

    async post(endpoint, data = {}, params = {}) {
        const isFormData = data instanceof FormData;

        return this.#fetchWithConfig(endpoint, {
            method: "POST",
            body: isFormData ? data : JSON.stringify(data),
            _isFormData: isFormData
        }, params);
    }

    async put(endpoint, data = {}, params = {}) {
        const isFormData = data instanceof FormData;

        return this.#fetchWithConfig(endpoint, {
            method: "PUT",
            body: isFormData ? data : JSON.stringify(data),
            _isFormData: isFormData
        }, params);
    }

    async delete(endpoint, params = {}) {
        return this.#fetchWithConfig(endpoint, {
            method: "DELETE"
        }, params);
    }
}
