import HttpClientBase from "./HttpClientBase.js";

export default class Addresses extends HttpClientBase {
    async register(data) {
        return this.post("/address/register", data);
    }

    async update(id, data) {
        return this.put("/address/update", { ...data, id });
    }

    async selectByUser() {
        return this.get("/address/by-user");
    }
}
