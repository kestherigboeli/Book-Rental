<template>
	<div class="container-fluid bg-light text-dark">
		<div class="row justify-content-center align-items-center">
			<h1>Form</h1>
		</div>
		<hr/>
		<div class="row justify-content-center align-items-center h-100">
			<div class="col col-sm-6 col-md-6 col-lg-6 col-xl-9">
				<div>
					<!--Login starts here-->
					<div class="row">
						<div class="col">
							<span class="text-danger" v-if="signInErrors">{{signInErrors.error}}</span>
							<div class="form-group">
								<input type="text" v-model="signin.email" class="form-control" placeholder="Enter Email" />
							</div>

							<div class="form-group">
								<input type="text" v-model="signin.password" class="form-control" placeholder="Password" />
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col">
										<button @click.prevent="login" class="col-4 btn btn-secondary btn-sm float-left">Login</button>
									</div>
								</div>
							</div>
						</div>

						<!--Login ends here -->


						<!--Registration starts here-->
						<div class="col">
							<div class="form-group">
								<input type="text" v-model="signUpForm.first_name" class="form-control" placeholder="Enter First Name" />
								<span class="text-danger m-0" style="font-size: 14px;" v-if="signUpFormErrors.first_name">{{signUpFormErrors.first_name[0]}}</span>
							</div>

							<div class="form-group">
								<input type="text" v-model="signUpForm.last_name" class="form-control" placeholder="Enter Last Name" />
								<span class="text-danger m-0" style="font-size: 14px;" v-if="signUpFormErrors.last_name">{{signUpFormErrors.last_name[0]}}</span>
							</div>

							<div class="form-group">
								<input type="email" v-model="signUpForm.email" class="form-control" placeholder="Enter Email Address" />
								<span class="text-danger m-0" style="font-size: 14px;" v-if="signUpFormErrors.email">{{signUpFormErrors.email[0]}}</span>
							</div>

							<div class="form-group">
								<input type="password" v-model="signUpForm.password" class="form-control" placeholder="Password" />
								<span class="text-danger m-0" style="font-size: 14px;" v-if="signUpFormErrors.password">{{signUpFormErrors.password[0]}}</span>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col">
										<button @click.prevent="register" class="col-6 btn btn-secondary btn-sm float-left">Register</button>
									</div>
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
    /* eslint-disable */
    import { mapActions } from 'vuex'
    export default {
	    data() {
            return {
                signin: {
                    email: '',
	                password: ''
                },
                signUpForm: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: ''
	            },
                signInErrors: {},
                signUpFormErrors: {}
            }
	    },

	    methods: {
		    ...mapActions({
			    signIn: 'auth/signIn',
			    registerUser: 'auth/signUp'
		    }),
		    register(){
		        this.registerUser(this.signUpForm)
			        .then( () => {
                        // this.signUpForm = {}
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Thanks for registering please login to continue',
                            showConfirmButton: false,
                            timer: 1500
                        })
			        })
			        .catch( error => {
                       this.signInErrors = '';
			            this.signUpFormErrors = error.response.data.errors
			        })
            },

		    login(){
			    this.signIn(this.signin)
				    .then( () => {
                    this.$router.replace({name: 'dashboard'});
                    this.signInErrors = "";
                    })
				    .catch( error => {
				        this.signInErrors = error.response.data
                        console.log(error.response);
				    })
	        }

	    }
    }
</script>

<style scoped>

</style>