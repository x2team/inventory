<template>
    <div>
        <div class="row">
            <router-link :to="{ name: 'Expense' }" class="btn btn-primary"
                >All Expense</router-link
            >
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
                                            Add New Expense
                                        </h1>
                                    </div>
                                    <form
                                        @submit.prevent="expenseInsert"
                                        class="expense"
                                        enctype="multipart/form-data"
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
                expense_date: null,
            },
            errors: {}
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },
    methods: {
        categoryInsert() {
            axios
                .post("/api/category", this.form)
                .then(res => {
                    this.$router.push({ name: "Category" });
                    Notification.success();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    },
    computed: {}
};
</script>

<style lang=""></style>
