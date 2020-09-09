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
                                            Pay Salary
                                        </h1>
                                    </div>
                                    <form @submit.prevent="employeeUpdate" class="edit-employee">

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name"><b> Name</b></label>
                                                <input
                                                    name="name"
                                                    type="text"
                                                    class="form-control"
                                                    id="name"
                                                    placeholder="Enter Your Full Name"
                                                    v-model="form.name"
                                                />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email"><b> Email</b></label>
                                                <input
                                                    name="email"
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
                                                <label for="salary_month"><b> Months</b></label>
                                                <select name="salary_month" class="form-control" id="salary_month" v-model="form.salary_month">
                                                    
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>

                                                </select>
                                                <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="salary"><b> Salary</b></label>
                                                <input
                                                    name="salary"
                                                    type="text"
                                                    class="form-control"
                                                    id="salary"
                                                    placeholder="Enter Your Salary"
                                                    v-model="form.salary"
                                                />
                                                <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                            </div>
                                        </div>

                                       

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                PayNow
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
                name: '',
                email: '',
                address: '',
                salary: '',
                joining_date: '',
                nid: '',
                phone: '',
                photo: 'default.jpg',
                newPhoto: '',
            },
            errors: {},
            
        };
    },
    mounted(){
        $('#simple-date1 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
        });
    },
	created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        let id = this.$route.params.id;
        axios.get('/api/employee/' + id)
            .then(res => {
                this.form = res.data;
            })
            .catch(error => {
                console.log(error);
            })
            
            

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
                    this.form.newPhoto = event.target.result;
                }
                reader.readAsDataURL(file);
                
            }
            // console.log(event.target.result);

        },
        employeeUpdate(){
            let id = this.$route.params.id;
            axios.patch('/api/employee/'+id, this.form)
                .then(res => {
                    this.$router.push({ name: 'Employee' });
                    Notification.success(); 
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
