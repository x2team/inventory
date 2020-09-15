<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Stock' }" class="btn btn-primary" >Go Back</router-link>
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
                                            Stock Update
                                        </h1>
                                    </div>
                                    <form @submit.prevent="stockUpdate" id="edit-stock-form">

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="product_quantity">Product Stock</label>
                                                <input
                                                    name="product_quantity"
                                                    type="text"
                                                    class="form-control"
                                                    id="product_quantity"
                                                    placeholder="Enter Your Product Name"
                                                    v-model="form.product_quantity"
                                                />
                                                <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Update
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
                product_quantity: null,
            },
            errors: {},           
        };
    },
	created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        let id = this.$route.params.id;
        axios.get('/api/product/' + id)
            .then(res => {
                this.form = res.data;
            })
            .catch(error => {
                console.log(error);
            });
	},
    methods: {
        
        stockUpdate(){
            let id = this.$route.params.id;
            let formData = new FormData(document.getElementById('edit-stock-form'));
            formData.append('_method', 'PUT')

            axios.post('/api/stock/update/'+id, formData )
                .then(res => {
                    if( ! res.data.errors){
                        this.$router.push({ name: 'Stock' });
                        Notification.success();
                    }
                    else{
                        this.errors = res.data.errors;
                    };
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
        },
        getUrlPhoto(){
            var urlPhoto = window.location.origin + '/storage/' + this.form.photo;
            return urlPhoto;
        }
    },
	computed: {
		
    }
};
</script>

<style>
#photo {
    height: 40px;
    width: 40px;
}


</style>
