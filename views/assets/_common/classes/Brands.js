import HttpClientBase from "./HttpClientBase.js";

export default class Brands extends HttpClientBase {
    async listAll() {
        return this.get("/brands");
    }

    async listById(id) {
        return this.get("/brands/:id", { id });
    }

    async insert(data) {
        return this.post("/brands", data);
    }

    async update(id, data) {
        return this.put("/brands/:id", data, { id });
    }

    async remove(id) {
        return this.delete("/brands/:id", { id });
    }
}
