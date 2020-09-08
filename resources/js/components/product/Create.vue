<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Product' }" class="btn btn-primary" >All Product</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Add New Product
                                        </h1>
                                    </div>
                                    <form @submit.prevent="productInsert" class="product" enctype="multipart/form-data" id="product-form">

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="product_name">Product Name</label>
                                                <input
                                                    name="product_name"
                                                    type="text"
                                                    class="form-control"
                                                    id="product_name"
                                                    placeholder="Enter Your Product Name"
                                                    v-model="form.product_name"
                                                />
                                                <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="product_code">Product Code</label>
                                                <input
                                                    name="product_code"
                                                    type="text"
                                                    class="form-control"
                                                    id="product_code"
                                                    placeholder="Enter Your Product Code"
                                                    v-model="form.product_code"
                                                />
                                                <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="category_id">Product Category</label>
                                                <select name="category_id" class="form-control" id="category_id" v-model="form.category_id">
                                                    
                                                    <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.category_name}}</option>

                                                </select>
                                                <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="supplier_id">Product Supplier</label>
                                                <select name="supplier_id" class="form-control" id="supplier_id">
                                                    
                                                    <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name}}</option>

                                                </select>
                                                <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="root">Product Root</label>
                                                <input
                                                    name="root"
                                                    type="text"
                                                    class="form-control"
                                                    id="root"
                                                    placeholder="Enter Product Name"
                                                    v-model="form.root"
                                                />
                                                <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="buying_price">Buying Price</label>
                                                <input
                                                    name="buying_price"
                                                    type="text"
                                                    class="form-control"
                                                    id="buying_price"
                                                    placeholder="Enter Buying Price"
                                                    v-model="form.buying_price"
                                                />
                                                <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="selling_price">Selling Price</label>
                                                <input
                                                    name="selling_price"
                                                    type="text"
                                                    class="form-control"
                                                    id="selling_price"
                                                    placeholder="Enter Selling Price"
                                                    v-model="form.selling_price"
                                                />
                                                <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input name="buying_date" type="text" class="form-control" placeholder="dd/mm/yyyy"  id="buying_date"
                                                            v-model="form.buying_date">
                                                <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>    
                                            </div>
                                            <div class="col-md-6">
                                                <input
                                                    name="product_quantity"
                                                    type="text"
                                                    class="form-control"
                                                    id="product_quantity"
                                                    placeholder="Enter Product Quantity"
                                                    v-model="form.product_quantity"
                                                />
                                                <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                                        <img src="https://place-hold.it/190x140?text=190x140&italic&bold"  alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-outline-secondary btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="image">
                                                        </span>
                                                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                        <hr />
                                    </form>
                                    <hr />
                                    <div class="text-center"></div>
                                </div>
                            </div>
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
            form: {
                category_id: null,
                product_name: null,
                product_code: null,
                root: null,
                buying_price: null,
                selling_price: null,
                supplier_id: null,
                buying_date: null,
                image: null,
                product_quantity: null,
            },
            errors: {},
            categories: {},
            suppliers: {}
            
        };
    },
	created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }


        axios.get('/api/category')
            .then(res => {
                this.categories = res.data;
            })
            .catch(error => {
                console.log(error);
            });

        axios.get('/api/supplier/')
            .then(res => {
                this.suppliers = res.data;
            })
            .catch(error => {
                console.log(error);
            });
	},
    methods: {
        productInsert(){

            var formData = new FormData(document.getElementById('product-form'));

            axios.post('/api/product', formData)
                .then(res => {
                    if( ! res.data.errors){
                        this.$router.push({ name: 'Product' });
                        Notification.success();
                    }
                    else{
                        this.errors = res.data.errors;
                    };
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })



            // axios.post('/api/employee', this.form)
            //     .then(res => {
            //         this.$router.push({ name: 'Employee' });
            //         Notification.success(); 
            //     })
            //     .catch(error => {
            //         this.errors = error.response.data.errors;
            //     })
        }
    },
	computed: {
		
    }
};
</script>

<style lang=""></style>
