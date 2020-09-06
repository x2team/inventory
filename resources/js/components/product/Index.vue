<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> -->
            <router-link :to="{ name: 'StoreEmployee' }" class="btn btn-primary"
                >Add New Employee</router-link
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
                            Employee List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Joining Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="employee in filterSearch"
                                    :key="employee.id"
                                >
                                    <td>{{ employee.name }}</td>
                                    <td>
                                        <img
                                            :src="'storage/' + employee.photo"
                                            id="photo"
                                        />
                                    </td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{ name: 'EditEmployee', params: {id:employee.id}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </router-link>
                                        <button
                                            @click="deleteEmployee(employee.id)"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>
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
            employees: [],
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allEmployee();
    },
    methods: {
        allEmployee() {
            axios
                .get("api/employee/")
                .then(res => {
                    this.employees = res.data;
                })
                .catch(error => {});
        },
        deleteEmployee(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {

                    /**
                     * Delete from Front End
                     */
                    axios.delete('api/employee/'+id)
                    .then(res => {
                        this.employees = this.employees.filter(employee => {
                            return employee.id !== id;
                        })
                    })
                    .catch(error => {
                        this.$router.push({ name: 'Employee' })
                    })


                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        },
        editEmployee()
        {
            console.log("Edit Employee");
        }
    },
    computed: {
        filterSearch() {
            return this.employees.filter(employee => {
                return (
                    employee.phone.match(this.searchTerm) ||
                    employee.name.match(this.searchTerm)
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
