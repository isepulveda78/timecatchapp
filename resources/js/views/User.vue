<template>
<div> 
          <!-- Header -->
    <div class="header bg-default pb-8 pt-5 pt-md-8">
          <div class="container-fluid mt-5">
            <div class="row">
          <div class="col-xl-7 order-xl-2 mb-5 mb-xl-0 offset-md-2">
            <div class="card card-profile shadow">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                        <v-gravatar :email="user.email" class="rounded-circle img-fluid" :size="200"/>
                    </a>
                  </div>
                </div>
              </div>
               <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                  <a href="#" class="btn btn-sm btn-info mr-4">Edit</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div>
                <div class="card-body py-5 mt-5 text-center">
                  <h3>
                    {{ user.name }}
                  </h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>University of Computer Science
                  </div>
                  <hr class="my-4" />
                  <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
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
    name: 'User',
    data()
    {
        return {
            user: '',
        }
    },
    mounted()
    {
        axios.get('/api/userinfo')
        .then(response => {
            this.user = response.data.data
        })
        .catch(error => {
             if (error.response.status === 404) {
            console.log("errors");
            }
        });
    }
}
</script>