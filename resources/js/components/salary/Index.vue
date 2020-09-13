<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> -->
            <router-link :to="{ name: 'GivenSalary' }" class="btn btn-primary"
                >Pay Salary</router-link
            >
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
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
                            All Salary Details
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Month Name</th>
                                    <th>Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="salary in filterSearch"
                                    :key="salary.id"
                                >
                                    <td>{{ salary.salary_month }}</td>
                                    
                                    <td>
                                        <router-link
                                            :to="{ name: 'ViewSalary', params: {id:salary.salary_month}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            View Salary
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

        this.allSalary();
    },
    methods: {
        allSalary() {
            axios
                .get("api/salary/")
                .then(res => {

                    this.salaries = res.data;
                    console.log(this.salaries);
                })
                .catch(error => {});
        },
        
      
    },
    computed: {
        filterSearch() {
            return this.salaries.filter(salary => {
                return (
                    salary.salary_month.match(this.searchTerm)
                );
            });
        }
    }
};
</script>

<style>
#photo {
    height: 40px;
    width: 40px;
}
</style>
