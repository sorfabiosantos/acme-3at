import HttpClientBase from "./HttpClientBase.js";

export default class Faqs extends HttpClientBase {
    async listAll() {
        return this.get("/faqs");
    }

    async listById(id) {
        return this.get("/faqs/:id", { id });
    }

    async insert(data) {
        return this.post("/faqs", data);
    }

    async update(id, data) {
        return this.put("/faqs/:id", data, { id });
    }

    async remove(id) {
        return this.delete("/faqs/:id", { id });
    }
}
