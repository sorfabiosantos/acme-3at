import HttpClientBase from "./HttpClientBase.js";

export default class Users extends HttpClientBase {
    async login(email, password) {
        return this.post("/users/login", { email, password });
    }

    async loginFromForm(form) {
        const formData = form instanceof HTMLFormElement
            ? new FormData(form)
            : form;
        return this.post("/users/login", {
            email: formData.get("email"),
            password: formData.get("password")
        });
    }

    async loginAdmin(email, password) {
        return this.post("/users/login-admin", { email, password });
    }

    async loginAdminFromForm(form) {
        const formData = form instanceof HTMLFormElement
            ? new FormData(form)
            : form;
        return this.post("/users/login-admin", {
            email: formData.get("email"),
            password: formData.get("password")
        });
    }

    async register(data) {
        return this.post("/users/register", data);
    }

    async update(data) {
        return this.put("/users/update", data);
    }

    async updateAdmin(data) {
        return this.put("/users/update-admin", data);
    }
}
