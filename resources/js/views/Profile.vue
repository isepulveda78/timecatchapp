<template>
<div>
    <div class="header pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
                    <div class="card card-profile shadow mt-5">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image mb-5">
                    <a href="#">
                        <v-gravatar :email="user.email" class="rounded-circle img-fluid" :size="200"/>
                    </a>
                  </div>
                </div>
              </div>
                <div class="card-body py-5 mt-5 text-center">
                  <h1>
                    {{ user.name }}
                  </h1>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{ user.location }}
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>{{ user.title }}
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>{{ user.education }}
                  </div>
                  <hr class="my-4" />
                  <h2>{{ user.about }}</h2>
                </div>
              </div>
      </div>
  </div>
</div>
</template>

<script>
export default {
    name: 'Profile',
      data()
    {
        return{
            user: '',
            taskcount: '',
            projectcount: '',
        }
    },
    mounted()
    {
        axios.get('/api/user/' + this.$route.params.id)
        .then(response => {
            this.user = response.data.data;
        })
        .catch(error => {
            console.log("errors");
        });

        axios.get('/api/projects/count')
        .then(response => {
            this.projectcount = response.data.data;
        })
        .catch(error => {
            console.log("errors");
        });
    }
}
</script>