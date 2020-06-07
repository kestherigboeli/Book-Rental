<template>
	<div class="container-fluid bg-light text-dark">
		<div class="row justify-content-center align-items-center">
			<h1>Form</h1>
		</div>
		<hr/>
		<div class="row justify-content-center align-items-center h-100">
			<div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<form>
					<!--Login starts here-->
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter Email" />
							</div>

							<div class="form-group">
								<input type="text" class="form-control" placeholder="Password" />
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
							<input type="text" class="form-control" placeholder="Last name">
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col">
									<button class="col-12 btn btn-secondary btn-sm float-left">Login</button>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        name: "login",

	    data() {
            return {
                formLogin: {
                    email: '',
	                password: ''
                }
            }
	    },

	    methods: {

            login(){
                alert('I am clicked')
            }
	    }
    }
</script>

<style scoped>

</style>