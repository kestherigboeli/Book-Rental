<template>
  <!-- Dashboard -->
  <div class="container-fluid" v-if="!loading">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-warning sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">

            <li class="nav-item">
              <router-link to="/dashboard" class="nav-link active" style="color: white">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/dashboard/users" class="nav-link active" style="color: white">
                <i class="fas fa-user"></i>
                Users
              </router-link>
            </li>

          </ul>

          <!--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">-->
            <!--<span>Saved reports</span>-->
            <!--<a class="d-flex align-items-center text-muted" href="#">-->
              <!--<span data-feather="plus-circle"></span>-->
            <!--</a>-->
          <!--</h6>-->
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>
        <p>Welcome: {{user.first_name}} {{user.last_name}} </p>

          <router-view></router-view>
      </main>
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
            },

            user() {
                 return this.$store.getters['auth/user']
            }
        },

        methods: {

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
            await axios.delete('user/'+ userID)
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
</style>