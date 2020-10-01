<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        POS
                    </li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Expense Insert
                            </h6>
                            <a href="#" class="btn btn-sm btn-info"
                                >Add Customer</a
                            >
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div
                                    class="table-responsive"
                                    style="font-size: 12px"
                                >
                                    <table
                                        class="table align-items-center table-flush"
                                    >
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="#">Name</a></td>
                                                <td>Qty</td>
                                                <td>Unit</td>
                                                <td>
                                                    <span
                                                        class="badge badge-success"
                                                        >Total</span
                                                    >
                                                </td>
                                                <td>
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm btn-danger"
                                                        >X</a
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer">
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            Total Quantity:
                                            <strong>23</strong>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            Sub Total:
                                            <strong
                                                >12 $</strong
                                            >
                                        </li>

                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            Vat:
                                            <strong
                                                >2 %</strong
                                            >
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                                            Total :
                                            <strong
                                                >23
                                                $</strong
                                            >
                                        </li>
                                    </ul>
                                    <br />

                                    <form>
                                        <label>Customer Name</label>
                                        <select
                                            class="form-control"
                                            v-model="customer_id"
                                        >
                                            <option>abc</option>
                                            <option>abc</option>
                                        </select>

                                        <label>Pay</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            required=""
                                            v-model="pay"
                                        />

                                        <label>Due</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            required=""
                                            v-model="due"
                                        />

                                        <label>Pay By</label>
                                        <select
                                            class="form-control"
                                            v-model="payby"
                                        >
                                            <option value="HandCash"
                                                >Hand Cash
                                            </option>
                                            <option value="Cheaque"
                                                >Cheaque
                                            </option>
                                            <option value="GiftCard"
                                                >Gift Card
                                            </option>
                                        </select>

                                        <br />
                                        <button
                                            type="submit"
                                            class="btn btn-success"
                                        >
                                            Submit
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Products Sold
                            </h6>
                        </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                    class="nav-link active"
                                    id="home-tab"
                                    data-toggle="tab"
                                    href="#home"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                    >All Products</a
                                >
                            </li>
                            <li
                                class="nav-item"
                                role="presentation"
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <a
                                    @click="subProduct(category.id)"
                                    class="nav-link"
                                    id="profile-tab"
                                    data-toggle="tab"
                                    href="#profile"
                                    role="tab"
                                    aria-controls="profile"
                                    aria-selected="false"
                                    >{{ category.category_name }}</a
                                >
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade show active"
                                id="home"
                                role="tabpanel"
                                aria-labelledby="home-tab"
                            >
                                <div class="card-body">
                                    <input
                                        v-model="searchTerm"
                                        type="text"
                                        class="form-control"
                                        placeholder="Search Here"
                                        style="width: 300px"
                                    />

                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-6 col-6"
                                            v-for="product in filterSearch"
                                            :key="product.id"
                                        >
                                            <div
                                                class="card"
                                                style="width: 8.5rem; margin-bottom: 5px"
                                            >
                                                <img
                                                    :src="
                                                        'storage/' +
                                                            product.image
                                                    "
                                                    id="fix_image "
                                                    height="100px"
                                                    width="115px"
                                                />
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        {{
                                                            product.product_name
                                                        }}
                                                    </h6>
                                                    <span
                                                        v-if="
                                                            product.product_quantity >=
                                                                1
                                                        "
                                                        class="badge badge-success"
                                                        >Available
                                                        {{
                                                            product.product_quantity
                                                        }}</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="badge badge-danger"
                                                        >Stock out</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="profile"
                                role="tabpanel"
                                aria-labelledby="profile-tab"
                            >
                                <input
                                    v-model="searchTerm"
                                    type="text"
                                    class="form-control"
                                    placeholder="Search Here"
                                    style="width: 300px"
                                />

                                <div class="row">
                                    <div
                                        class="col-lg-3 col-md-3 col-sm-6 col-6"
                                        v-for="getProduct in getFilterSearch"
                                        :key="getProduct.id"
                                    >
                                        <div
                                            class="card"
                                            style="width: 8.5rem; margin-bottom: 5px"
                                        >
                                            <img
                                                :src="
                                                    'storage/' +
                                                        getProduct.image
                                                "
                                                id="fix_image "
                                                height="100px"
                                                width="115px"
                                            />
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    {{
                                                        getProduct.product_name
                                                    }}
                                                </h6>
                                                <span
                                                    v-if="
                                                        getProduct.product_quantity >=
                                                            1
                                                    "
                                                    class="badge badge-success"
                                                    >Available
                                                    {{
                                                        getProduct.product_quantity
                                                    }}</span
                                                >
                                                <span
                                                    v-else
                                                    class="badge badge-danger"
                                                    >Stock out</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->

            <!-- Modal Logout -->
            <div
                class="modal fade"
                id="logoutModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabelLogout"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title"
                                id="exampleModalLabelLogout"
                            >
                                Ohh No!
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-outline-primary"
                                data-dismiss="modal"
                            >
                                Cancel
                            </button>
                            <a href="login.html" class="btn btn-primary"
                                >Logout</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            categories: "", // [] van chay
            getProducts: [],
            searchTerm: "",
            getSearchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allProduct();
        this.allCategory();
    },
    methods: {
        allProduct() {
            axios
                .get("api/product/")
                .then(res => {
                    this.products = res.data;
                })
                .catch(error => {});
        },
        allCategory() {
            axios
                .get("api/category/")
                .then(res => {
                    this.categories = res.data;
                })
                .catch(error => {});
        },
        subProduct(id) {
            axios
                .get("api/getting/product/" + id)
                .then(res => {
                    this.getProducts = res.data;
                })
                .catch(error => {});
        }
    },
    computed: {
        filterSearch() {
            return this.products.filter(product => {
                return (
                    product.product_name.match(this.searchTerm) ||
                    product.product_code.match(this.searchTerm)
                );
            });
        },
        getFilterSearch() {
            return this.getProducts.filter(getProduct => {
                return (
                    getProduct.product_name.match(this.getSearchTerm) ||
                    getProduct.product_code.match(this.getSearchTerm)
                );
            });
        }
    }
};
</script>

<style type="text/css" scoped>
img#fix_image {
    height: 40px !important;
    width: 40px !important;
    border: 5px solid red;
}
h1 {
    color: red !important;
}
</style>
