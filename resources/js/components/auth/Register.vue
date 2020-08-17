<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Register
                                        </h1>
                                    </div>
                                    <form @submit.prevent="signup">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputFirstName"
                                                placeholder="Enter Your Full Name"
												v-model="form.name"
												v-bind:class="hasName"
                                            />
											<div class="invalid-feedback" v-if="errors.name">
                                                {{ errors.name[0] }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="exampleInputEmail"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Your Email Address"
												v-model="form.email"
												v-bind:class="hasEmail"
                                            />
											<div class="invalid-feedback" v-if="errors.email">
                                                {{ errors.email[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="exampleInputPassword"
                                                placeholder="Password"
												v-model="form.password"
												v-bind:class="hasPassword"
                                            />
											<div class="invalid-feedback" v-if="errors.password">
                                                {{ errors.password[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="exampleInputPasswordRepeat"
                                                placeholder="Repeat Password"
												v-model="form.password_confirmation"
                                            	v-bind:class="hasPasswordConfirmation"
                                            />
											<div class="invalid-feedback" v-if="errors.password_confirmation">
                                                {{ errors.password_confirmation[0] }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Register
                                            </button>
                                        </div>
                                        <hr />
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <router-link
                                            :to="{ name: '/' }"
                                            class="font-weight-bold small"
                                            >Already have an
                                            account?</router-link
                                        >
                                    </div>
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
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errors: {},
            isName: false,
            isEmail: false,
            isPassword: false,
            isPasswordConfirmation: false,
        };
    },
	created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "Home" });
        }
	},
    methods: {
        signup() {
            axios
                .post(`/api/auth/signup`, this.form)
                .then(res => {
                    User.responseAfterLogin(res);
                    Toast.fire({
                        icon: "success",
                        title: "Register in successfully"
                    });
                    this.$router.push({ name: "Home" });
                })
                .catch(error => {
                    // handle error
                    this.isEmail = false;
                    this.isPassword = false;
                    this.errors = {};

                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }

                    if (this.errors) {
                        if (this.errors.email) {
                            this.isEmail = true;
                        }
                        if (this.errors.password) {
                            this.isPassword = true;
                        }
                    }

                    console.log(error.response.data);
                });
        }
    },
	computed: {
		hasName() {
            return {
                'is-invalid': this.isEmail
            }
        },
        hasEmail() {
            return {
                'is-invalid': this.isEmail
            }
        },
        hasPassword(){
            return {
                'is-invalid': this.isPassword
            }
		},
		hasPasswordConfirmation(){
			return {
                'is-invalid': this.isPasswordConfirmation
            }
		}
    }
};
</script>

<style lang=""></style>
