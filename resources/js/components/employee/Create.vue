<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Employee' }" class="btn btn-primary" >All Employee</router-link>
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
                                            Add New Employee
                                        </h1>
                                    </div>
                                    <form @submit.prevent="employeeInsert" class="employee" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <div class="col-md-6">
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
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="salary"
                                                    placeholder="Enter Your salary"
                                                    v-model="form.salary"
                                                />
                                                <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <!-- <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="01/06/2020" id="joining_date"
                                                            v-model="form.joining_date">
                                                </div> -->
                                                <input type="date" class="form-control" value="dd/mm/yyyy" id="joining_date"
                                                            v-model="form.joining_date">
                                                <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>    
                                            </div>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="nid"
                                                    placeholder="Enter Your Nid"
                                                    v-model="form.nid"
                                                />
                                                <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="phone"
                                                    placeholder="Enter Your Phone"
                                                    v-model="form.phone"
                                                />
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="custom-file">
                                                    <input @change="onFileSelected" type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <img :src="form.photo" style="height: 40px; width: 40px;">
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
                address: null,
                salary: null,
                joining_date: null,
                nid: null,
                phone: null,
                photo: null,
            },
            errors: {},
            
        };
    },
	created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
	},
    methods: {
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size > 1048576){
                Notification.image_validation();
            }
            else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result;
                    // console.log(event.target.result);
                }
                reader.readAsDataURL(file);
                
            }
            // console.log(event.target.result);

        },
        employeeInsert(){
           
            axios.post('/api/employee', this.form)
                .then(res => {
                    this.$router.push({ name: 'Employee' });
                    Notification.success(); 
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
