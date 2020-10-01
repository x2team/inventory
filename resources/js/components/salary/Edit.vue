<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'AllSalary' }" class="btn btn-primary" >Go Back</router-link>
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
                                            Update Salary
                                        </h1>
                                    </div>
                                    <form @submit.prevent="salaryUpdate" class="edit-employee">

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

                                            <input type="hidden" v-model="form.employee_id">

                                            <div class="col-md-6">
                                                <label for="amount"><b> Amount</b></label>
                                                <input
                                                    name="amount"
                                                    type="text"
                                                    class="form-control"
                                                    id="amount"
                                                    placeholder="Enter Your Amount"
                                                    v-model="form.amount"
                                                />
                                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
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
                name: '',
                email: '',
                salary_month: '',
                amount: '',
                employee_id: '',

            },
            errors: {},
            
        };
    },
    // mounted(){
    //     $('#simple-date1 .input-group.date').datepicker({
    //         format: 'dd/mm/yyyy',
    //         todayBtn: 'linked',
    //         todayHighlight: true,
    //         autoclose: true,        
    //     });
    // },
	created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        let id = this.$route.params.id;
        axios.get('/api/edit/salary/' + id)
            .then(res => {
                this.form = res.data;
                console.log(this.form);
            })
            .catch(error => {
                console.log(error);
            })            

	},
    methods: {
        salaryUpdate(){
            let id = this.$route.params.id;
            axios.post('/api/salary/update/'+id, this.form)
                .then(res => {
                    if( ! res.data.errors){
                        this.$router.push({ name: 'AllSalary' });
                        Notification.success();
                        
                    }
                   
                    else
                    {
                        this.errors = res.data.errors;   
                    }                   
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    console.log(this.errors);
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


