<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <router-link :to="{ name: 'StoreCategory' }" class="btn btn-primary"
                >Add New Category</router-link
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
                            Category List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="category in filterSearch"
                                    :key="category.id"
                                >
                                    <td>{{ category.category_name }}</td>
                                    
                                    <td>
                                        <router-link
                                            :to="{ name: 'EditCategory', params: {id:category.id}}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </router-link>
                                        <button
                                            @click="deleteCategory(category.id)"
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
            categories: [],
            searchTerm: ""
        };
    },
    created() {
        // Check Logged in?
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }

        this.allCategory();
    },
    methods: {
        allCategory() {
            axios
                .get("api/category/")
                .then(res => {
                    this.categories = res.data;
                })
                .catch(error => {});
        },
        deleteCategory(id) {
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
                    axios.delete('api/category/'+id)
                    .then(res => {
                        this.categories = this.categories.filter(category => {
                            return category.id !== id;
                        })
                    })
                    .catch(error => {
                        this.$router.push({ name: 'Category' })
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
            return this.categories.filter(category => {
                return (
                    category.category_name.match(this.searchTerm)
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
