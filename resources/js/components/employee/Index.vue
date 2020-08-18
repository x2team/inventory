<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'StoreEmployee' }" class="btn btn-primary" >Add New Employee</router-link>
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
                                            All Employee
                                        </h1>
                                    </div>
                                    
                                    
                                    
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
            
        };
    },
	created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
	},
    methods: {
        
    },
	computed: {
	
    }
};
</script>

<style lang=""></style>
