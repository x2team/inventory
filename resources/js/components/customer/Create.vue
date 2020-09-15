<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Customer' }" class="btn btn-primary" >All Customers</router-link>
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
                                            Add New Customer
                                        </h1>
                                    </div>
                                    <form id="customer-form" @submit.prevent="customerInsert" class="customer" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name">Customer Name</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="name"
                                                    placeholder="Enter Your Full Name"
                                                    v-model="form.name"
                                                />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Customer Email</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="email"
                                                    placeholder="Enter Your Email"
                                                    v-model="form.email"
                                                />
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="address">Customer Address</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="address"
                                                    placeholder="Enter Your Address"
                                                    v-model="form.address"
                                                />
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">Customer Phone</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="phone"
                                                    placeholder="Enter Your phone"
                                                    v-model="form.phone"
                                                />
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new img-thumbnail" style="width: 100px; height: 100px;">
                                                        <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                                        <img src="https://ui-avatars.com/api/?size=100&name=av"  alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-outline-secondary btn-file">
                                                            <span class="fileinput-new">Select photo</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="photo">
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
                name: null,
                email: null,
                phone: null,
                address: null,
                photo: null,
            },
            errors: {},
            
        };
    },
	created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
	},
    methods: {
        
        customerInsert(){
            
            let formData = new FormData(document.getElementById('customer-form'));

            axios.post('/api/customer', formData)
                .then(res => {
                    if( ! res.data.errors){
                        this.$router.push({ name: 'Customer' });
                        Notification.success();
                    }
                    else{
                        this.errors = res.data.errors;
                    }; 
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
        }
    },
	computed: {
		
    }
};
</script>

<style lang=""></style>
