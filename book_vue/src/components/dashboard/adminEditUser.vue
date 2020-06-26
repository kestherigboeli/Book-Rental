<template>
	<div>
		<form class="text-center col-sm-12">
			<div class="row">
				<div class="col-sm-4">
					<input type="text" v-model="user.first_name" class="form-control" placeholder="First name">
					<span class="text-danger" v-if="userError.first_name">{{userError.first_name[0]}}</span>
				</div>
				<div class="col-sm-4">
					<input type="text" v-model="user.last_name" class="form-control" placeholder="Last name">
					<span class="text-danger" v-if="userError.last_name">{{userError.last_name[0]}}</span>

				</div>
			</div>

			<div class="row pt-3">
				<div class="col-sm-4">
					<input type="text" v-model="user.email" class="form-control" placeholder="Email">
					<span class="text-danger" v-if="userError.email">{{userError.email[0]}}</span>
				</div>
			</div>

			<div class="row pt-3">
				<div class="ml-3">
					<button type="button" @click.prevent="updateUser()" class="btn btn-primary mb-2">Update User</button>
				</div>
			</div>
		</form>

		<form class="text-center col-sm-4 pt-2">
			<div class="row">
				<div class="col">
					<input type="password" v-model="password.current_password" class="form-control" placeholder=" Enter Old Password">
					<span class="text-danger" v-if="passwordError.current_password || passwordError.message">Please enter your old password</span>
				</div>
			</div>

			<div class="row">
				<div class="col pt-3">
					<input type="password" v-model="password.new_password" class="form-control" placeholder="Enter New Password">
					<span class="text-danger" v-if="passwordError.new_password">{{passwordError.new_password[0]}}</span>
					<span class="text-danger" v-if="passwordError.new_confirm_password">{{passwordError.new_confirm_password[0]}}</span>
				</div>
			</div>
			<div class="row">
				<div class="col pt-3">
					<input type="password" v-model="password.new_confirm_password" class="form-control" placeholder="Confirm New Password">
				</div>
			</div>

			<div class="row pt-3">
				<div class="ml-3">
					<button type="button" @click.prevent="updatePassword()" class="btn btn-primary mb-2">Update Password</button>
				</div>
			</div>
		</form>

	</div>
</template>

<script>
    /* eslint-disable */
    import axios from "axios"
    export default {
        name: "adminEditUser",

	    data() {
		    return {
		        user: {
                    first_name: '',
                    last_name: '',
                    email: '',
		        },
			    password: {
                    current_password: '',
                    new_password: '',
                    new_confirm_password: ''
			    },
			    passwordError: '',
			    userError: ''

		    }
	    },

	    created() {
            this.getUser();
	    },

	    methods: {
            async getUser() {
                await axios.get(`/user/${this.$route.params.user_id}`)
	                .then( response => {
	                    console.log(response.data.data);
	                    this.user = response.data.data
	                })
	                .catch( () => {
	                    this.$router.push('/dashboard')
                        this.$swal({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Invalid user id, Please try again',
                            showConfirmButton: false,
                            timer: 3000
                        })
	                })
            },

            updateUser() {
                axios.post(`/user/update/${this.$route.params.user_id}`, this.user)
                    .then( response => {
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        this.userError={};

                    })
                    .catch( error => {
                        console.log(error.response.data.errors)
                        this.userError = error.response.data.errors
                    });
            },

		    updatePassword() {
                axios.patch(`/user/password/${this.$route.params.user_id}`, this.password)
	                .then( response => {
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
		                this.password={};
						this.passwordError = ''
	                })
	                .catch( error => {
	                    console.log(error.response.data.errors)
	                    this.passwordError = error.response.data.errors
	                })
            },
	    }
    }
</script>

<style scoped>

</style>