<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'Expense' }" class="btn btn-primary" >All Expense</router-link>
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
                                            Expense Update
                                        </h1>
                                    </div>
                                    
                                    <form
                                        @submit.prevent="expenseUpdate"
                                        class="expense"
                                        enctype="multipart/form-data"
                                        id="expense-form"
                                    >
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="detail">Expense Details</label>
                                                <textarea
                                                    class="form-control"
                                                    id="detail"
                                                    rows="3"
                                                    name="detail"
                                                    v-model="form.detail"
                                                ></textarea>
                                                <small
                                                    class="text-danger"
                                                    v-if="errors.detail"
                                                    >{{
                                                        errors.detail[0]
                                                    }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="amount">Expense Amount</label>
                                                <input
                                                    name="amount"
                                                    type="text"
                                                    class="form-control"
                                                    id="amount"
                                                    placeholder="Enter Your amount"
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
                                                Create
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
                detail: null,
                amount: null,
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
        axios.get('/api/expense/' + id)
            .then(res => {
                this.form = res.data;
            })
            .catch(error => {
                console.log(error);
            })

    },
    
    methods: {
        expenseUpdate(){
            
            let id = this.$route.params.id;
            var formData = new FormData(document.getElementById('expense-form'));
            formData.append('_method', 'PUT')


            axios.post('/api/expense/'+id, formData)
                .then(res => {
                    
                    if( ! res.data.errors){
                        this.$router.push({ name: 'Expense' });
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
    },
	computed: {
		
    }
};
</script>
