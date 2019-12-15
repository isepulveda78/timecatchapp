<template>
<div> 
          <!-- Header -->
      
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
                  <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Add to your profile" @click.prevent="loadUserModal(user)">Edit</a>
                </div>
              </div>
                <div class="card-body py-5 mt-5 text-center">
                  <h3>
                    {{ user.name }}
                  </h3>
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
                  <p>{{ user.about }}</p>
                </div>
              </div>
            
        

    <!-- Modal -->
      <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header border-bottom">
                <h1 class="modal-title" id="modal-title-default">Edit Profile</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body">
                <form autocomplete="off">
                  <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" id="name" v-model="new_info.name" disabled>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" v-model="new_info.email" disabled>
                  </div>
                  <div class="form-group">
                      <label for="location">Location</label>
                      <input type="text" class="form-control" id="location" placeholder="Example: Raleigh, North Carolina" v-model="new_info.location">
                  </div>
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" placeholder="Example: Full Stack Web Developer" v-model="new_info.title">
                  </div>
                  <div class="form-group">
                      <label for="education">Education</label>
                      <input type="text" class="form-control" id="education" placeholder="Example: University of North Carolina" v-model="new_info.education">
                  </div>
                  <div class="form-group">
                      <label for="about">About</label>
                      <input type="text" class="form-control" id="about" placeholder="Short Description of Yourself" v-model="new_info.about">
                  </div>
                    <button type="button" class="btn btn-danger mt-2" @click.prevent="updateUser(user.id)">Save changes</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            form: {
                    'name': '',
                    'email': '',
                    'location': '',
                    'title': '',
                    'education': '',
                    'about': ''
                },
                new_info: []
            }
    },
    methods:
    {
        loadUserModal()
        {
            $("#updateUser").modal("show");
            this.new_info = this.user
        },
        updateUser()
        {
            axios.patch('/api/user/' + this.user.id,{
                name: this.new_info.name,
                email: this.new_info.email,
                location: this.new_info.location,
                title: this.new_info.title,
                education: this.new_info.education,
                about: this.new_info.about
            })
            .then(response => {
                $("#updateUser").modal("hide");
            })
            .catch(error => {
                console.log("errors");
            })
        }
    },
    mounted()
    {
        axios.get('/api/userinfo')
        .then(response => {
            this.user = response.data.data
        })
        .catch(error => {
            console.log("errors");
        });
    }
}
</script>