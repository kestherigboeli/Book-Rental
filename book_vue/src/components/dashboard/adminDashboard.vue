<template>
	<div>

		<h2>List of current users</h2>
		<button type="button" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModal">Add New User</button>
		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
				<tr>
					<th>Full Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Role</th>
					<th>Edit    Delete</th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(user, index) in users" :key="user.user_id">
					<td>{{user.first_name}} {{user.last_name}}</td>
					<td>{{user.email}}</td>
					<td>{{user.status}}</td>
					<td>
						<select class="form-control" id="sel1" v-on:change="UpdateRole($event)">
							<option value="1">User</option>
							<option value="2">Admin</option>
							<option value="3">Super Admin</option>
						</select>
					</td>
					<td>
						<router-link :to="`/dashboard/user/${user.user_id}`" class="pr-5">
							<i class="fas fa-pencil-alt" style="color: green"></i>
						</router-link>

						<a @click="deleteUser(user.user_id, index)">
							<i class="far fa-trash-alt" style="color: red; cursor: pointer"></i>
						</a>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<!--modal pop up-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">New message</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>

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
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click.prevent="hide_Modal()" data-dismiss="modal">Close</button>
						<button @click.prevent="addNewUser()" type="button" class="btn btn-primary">Send message</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    /* eslint-disable */
    import axios from "axios"
    import { mapActions, mapGetters, mapState } from 'vuex'

    export default {

        data() {
            return {
                selected: '',
                loading: false,
                signUpForm: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: ''
                },
                signUpFormErrors: {},
                modal: false
            }
        },

        created() {
            this.getAllUsers();
        },

        computed: {
            users() {
                return this.$store.getters['auth/users']
            }
        },

        methods: {

            UpdateRole(event){

                console.log(event)
            },

            getAllUsers() {

                this.getUsers()
            },

            hide_Modal() {
                this.modal = true;
                this.signUpFormErrors = {};
            },

            ...mapActions({
                signIn: 'auth/signIn',
                registerUser: 'auth/signUp',
                getUsers: 'auth/getAllUsers',
            }),

            async deleteUser(userID, index) {
                await axios.delete('/user/'+ userID)
                    .then( () => {
                        this.users.splice(index, 1)
                    })
                    .catch( () => {
                        console.log('Unable to delete this user')
                    })
            },

            addNewUser() {
                this.registerUser(this.signUpForm)
                    .then( () => {
                        this.signUpForm = {};
                        this.hide_Modal();
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'User Added successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .catch( error => {
                        this.signUpFormErrors = error.response.data.errors
                    })
            }
        },
    }

</script>

<style scoped>
	.table td, .table th {
		vertical-align: middle;
	}
</style>