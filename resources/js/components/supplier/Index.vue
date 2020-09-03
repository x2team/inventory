<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> -->
            <router-link :to="{ name: 'StoreSupplier' }" class="btn btn-primary"
                >Add New Supplier</router-link
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
                            Supplier List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="supplier in filterSearch"
                                    :key="supplier.id"
                                >
                                    <td>{{ supplier.name }}</td>
                                    <td>
                                        <img
                                            :src="'storage/' + supplier.photo"
                                            id="photo"
                                        />
                                    </td>
                                    <td>{{ supplier.phone }}</td>
                                    <td>{{ supplier.shopname }}</td>
                                    <td>{{ supplier.email }}</td>
                                    <td>
                                        <router-link
                                            :to="{ name: 'EditSupplier', params: {id:supplier.id}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </router-link>
                                        <button
                                            @click="deleteSupplier(supplier.id)"
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
            suppliers: [],
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allSupplier();
    },
    methods: {
        allSupplier() {
            axios
                .get("api/supplier/")
                .then(res => {
                    this.suppliers = res.data;
                })
                .catch(error => {});
        },
        deleteSupplier(id) {
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
                    axios.delete('api/supplier/'+id)
                    .then(res => {
                        this.suppliers = this.suppliers.filter(supplier => {
                            return supplier.id !== id;
                        })
                    })
                    .catch(error => {
                        this.$router.push({ name: 'Supplier' })
                    })


                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        },
       
    },
    computed: {
        filterSearch() {
            return this.suppliers.filter(supplier => {
                return (
                    supplier.phone.match(this.searchTerm) ||
                    supplier.name.match(this.searchTerm)
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
