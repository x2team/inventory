<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> -->
            <router-link :to="{ name: 'StoreProduct' }" class="btn btn-primary"
                >Add New Product</router-link
            >
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="./">Home</a>
                </li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">
                    Simple Tables
                </li>
            </ol>
        </div>

        <div class="form-group">
            <input
                v-model="searchTerm"
                type="text"
                class="form-control"
                placeholder="Search Here"
                style="width: 300px"
            />
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Stock
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Photo</th>
                                    <th>Category</th>
                                    <th>Buying Price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="product in filterSearch"
                                    :key="product.id"
                                >
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>
                                        <img
                                            :src="'storage/' + product.image"
                                            id="photo"
                                        />
                                    </td>
                                    <td>{{ product.category_name }}</td>
                                    <td>{{ product.buying_price }}</td>
                                    
                                    <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Available</span></td>
                                    <td v-else=" "><span class="badge badge-danger">Stock out</span></td>    

                                    <td>{{ product.product_quantity }}</td>
                                    <td>
                                        <router-link
                                            :to="{ name: 'EditStock', params: {id:product.id}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </router-link>
                                        
                                        <!-- <button
                                            @click="deleteProduct(product.id)"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
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
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allProduct();
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
        
      
    },
    computed: {
        filterSearch() {
            return this.products.filter(product => {
                return (
                    product.product_name.match(this.searchTerm) ||
                    product.product_code.match(this.searchTerm)
                );
            });
        }
    }
};
</script>

