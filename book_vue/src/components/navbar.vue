<template>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<!--<a class="navbar-brand" href="#">Hidden brand</a>-->
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

				<li class="nav-item active">
					<router-link class="nav-link" to="/">Home <span class="sr-only">(current)</span></router-link>
				</li>
			</ul>

			<ul class="navbar-nav mt-2 mt-lg-0">
				<li class="nav-item active" v-if="!authenticated">
					<router-link class="nav-link" to="/login">Login</router-link>
				</li>

				<template v-if="authenticated">
					<li class="nav-item active">
						<a class="nav-link sign-out" @click.prevent="signOut()">Logout</a>
					</li>

					<li class="nav-item active">
						<router-link class="nav-link" to="/dashboard" >Dashboard</router-link>
					</li>
				</template>
			</ul>

			<!--<form class="form-inline my-2 my-lg-0">-->
				<!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
				<!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
			<!--</form>-->
		</div>
	</nav>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex'

    export default {
	    methods: {
            ...mapActions( {
                signOutAction: 'auth/signOut'
            }),

            signOut() {
                this.signOutAction()
	                .then( () => {
	                    this.$router.replace({name: 'Home'})
	                })
	                .catch( () => {
	                    localStorage.removeItem('token')
	                })
            }
	    },

	    computed: {
		    ...mapGetters( {
				authenticated: 'auth/authenticated',
				user: 'auth/user'
		    })
	    },

    }
</script>

<style scoped>

	.sign-out {
		cursor: pointer;
	}
</style>