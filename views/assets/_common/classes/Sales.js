import HttpClientBase from "./HttpClientBase.js";

export default class Sales extends HttpClientBase {
    async listAll() {
        return this.get("/sales");
    }

    async insert(data) {
        return this.post("/sales", data);
    }
}
