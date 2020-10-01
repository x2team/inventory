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
                                Monthly Recap Report
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                fasdf
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch"
                                        :key="product.id">

                                        <div class="card" >
                                            <img
                                                :src="'storage/' + product.image"
                                                id="fix_image "
                                                
                                            />
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ product.product_name }}
                                                </h5>
                                                
                                                
                                                
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
    h1{
        color: red !important;
    }

</style>

