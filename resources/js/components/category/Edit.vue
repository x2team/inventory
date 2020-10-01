<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Category' }" class="btn btn-primary" >All Category</router-link>
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
                                            Category Update
                                        </h1>
                                    </div>
                                    <form @submit.prevent="categoryUpdate" class="edit-category" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="category_name"
                                                    placeholder="Enter Your Category Name"
                                                    v-model="form.category_name"
                                                />
                                                <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
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
                category_name: null,
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
        axios.get('/api/category/' + id)
            .then(res => {
                this.form = res.data;
            })
            .catch(error => {
                console.log(error);
            })

    },
    
    methods: {
        categoryUpdate(){
            let id = this.$route.params.id;
            axios.patch('/api/category/'+id, this.form)
                .then(res => {
                    this.$router.push({ name: 'Category' });
                    Notification.success(); 
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
        },
    },
	computed: {
		
    }
};
</script>
