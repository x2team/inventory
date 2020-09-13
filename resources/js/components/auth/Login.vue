<template>
    <div>
        <!-- <div class="container-login"> -->
       

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Login
                                        </h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input
                                                v-model="form.email"
                                                v-bind:class="hasEmail"
                                                type="email"
                                                class="form-control"
                                                id="exampleInputEmail"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address"
                                            />
                                            <div class="invalid-feedback" v-if="errors.email">
                                                {{ errors.email[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input
                                                v-model="form.password"
                                                v-bind:class="hasPassword"
                                                type="password"
                                                class="form-control"
                                                id="exampleInputPassword"
                                                placeholder="Password"
                                            />
                                            <div class="invalid-feedback" v-if="errors.password">
                                                {{ errors.password[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox small"
                                                style="line-height: 1.5rem;"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="customCheck"
                                                />
                                                <label
                                                    class="custom-control-label"
                                                    for="customCheck"
                                                >
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                                >Login</button>
                                        </div>
                                        <hr />
                                    </form>

                                    <hr />
                                    <div class="text-center">
                                        <router-link
                                            :to="{ name: 'Register' }"
                                            class="font-weight-bold small"
                                            >Create an Account!</router-link
                                        >
                                    </div>
                                    <div class="text-center">
                                        <router-link
                                            :to="{ name: 'Forget' }"
                                            class="font-weight-bold small"
                                            href="#"
                                            >Forget Password!</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: 'admin@gmail.com',
                password: 'password'
            },
            errors: {},
            isEmail: false,
            isPassword: false,
        };
    },

    methods: {
        login(){
            axios.post('/api/auth/login', this.form)
                .then(res => {
                    User.responseAfterLogin(res);
                    Toast.fire({
                        icon: "success",
                        title: "Signed in successfully"
                    });
                    this.$router.push({ name: "Home" });
                })
                .catch(error => {
                    // handle error
                    this.isEmail = false;
                    this.isPassword = false;
                    this.errors = {};

                    if(error.response.data.errors){
                        this.errors = error.response.data.errors;
                    }
                    

                    if(this.errors){
                        if(this.errors.email){
                            this.isEmail = true;
                        }
                        if(this.errors.password){
                            this.isPassword = true;
                        }
                    }

                    console.log(error.response.data);
                })
                // .catch(
                //     Toast.fire({
                //         icon: "warning",
                //         title: "Invalid Email or Password,."
                //     })
                // );
        }
    },
    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "Home" });
        }
    },
    // beforeCreate(){
    //     console.log(this.isEmail);
    // },
    computed: {
        hasEmail() {
            return {
                'is-invalid': this.isEmail
            }
        },
        hasPassword(){
            return {
                'is-invalid': this.isPassword
            }
        }
    }
};
</script>

<style></style>
