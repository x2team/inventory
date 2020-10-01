<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <router-link :to="{ name: 'StoreCustomer' }" class="btn btn-primary"
                >Add New Customer</router-link
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
                            Customer List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="customer in filterSearch"
                                    :key="customer.id"
                                >
                                    <td>{{ customer.name }}</td>
                                    <td>
                                        <img
                                            :src="'storage/' + customer.photo"
                                            id="photo"
                                        />
                                    </td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <router-link
                                            :to="{ name: 'EditCustomer', params: {id:customer.id}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </router-link>
                                        <button
                                            @click="deleteCustomer(customer.id)"
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
            customers: [],
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allCustomer();
    },
    methods: {
        allCustomer() {
            axios
                .get("api/customer/")
                .then(res => {
                    this.customers = res.data;
                })
                .catch(error => {});
        },
        deleteCustomer(id) {
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
                    axios.delete('api/customer/'+id)
                    .then(res => {
                        this.customers = this.customers.filter(customer => {
                            return customer.id !== id;
                        })
                    })
                    .catch(error => {
                        this.$router.push({ name: 'Customer' })
                    })


                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        },
        editCustomer()
        {
            console.log("Edit Customer");
        }
    },
    computed: {
        filterSearch() {
            return this.customers.filter(customer => {
                return (
                    customer.phone.match(this.searchTerm) ||
                    customer.name.match(this.searchTerm)
                );
            });
        }
    }
};
</script>

