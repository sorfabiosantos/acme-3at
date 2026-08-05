import HttpClientBase from "./HttpClientBase.js";

export default class Products extends HttpClientBase {
    async listAll() {
        return this.get("/products/list");
    }

    async listById(id) {
        return this.get("/products/list/:product_id", { product_id: id });
    }

    async listPaginator(page = 1, perPage = 10) {
        return this.get("/products/list/paginator/:page/:per_page", {
            page,
            per_page: perPage
        });
    }

    async insert(data) {
        return this.post("/products/", data);
    }

    async update(id, data) {
        return this.put("/products/:product_id", data, {
            product_id: id
        });
    }

    async remove(id) {
        return this.delete("/products/:product_id", {
            product_id: id
        });
    }
}
