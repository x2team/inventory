<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> -->
            <router-link :to="{ name: 'AllSalary' }" class="btn btn-primary"
                >Go Back</router-link
            >
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="./">Home</a>
                </li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">
                    Simple Tables
                </li>
            </ol>
        </div>

        <div class="form-group">
            <input
                v-model="searchTerm"
                type="text"
                class="form-control"
                placeholder="Search Here"
                style="width: 300px"
            />
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Employee Salary Detail
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="salary in filterSearch"
                                    :key="salary.id"
                                >
                                    <td>{{ salary.name }}</td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>{{ salary.amount }}</td>
                                    <td>{{ salary.salary_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'EditSalary',
                                                params: { id: salary.id }
                                            }"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit Salary
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            salaries: [],
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.viewSalary();
    },
    methods: {
        viewSalary() {
            let id = this.$route.params.id;
            axios
                .get("/api/salary/view/" + id)
                .then(res => {
                    if (!res.data.errors) {

                        this.salaries = res.data;
                        // this.$router.push({ name: "GivenSalary" });
                        Notification.success();

                    } else if (res.data.errors == "Salary already Paid.") {
                        Notification.warning_text("Salary already Paid.");
                    } else {
                        this.errors = res.data.errors;
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    console.log(this.errors);
                });
        }
    },
    computed: {
        filterSearch() {
            return this.salaries.filter(salary => {
                return salary.name.match(this.searchTerm);
            });
        }
    }
};
</script>

