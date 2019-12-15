<template>
    <div>
          <!-- Navbar -->
          <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
              <!-- Brand -->
              <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Dashboard</a>
              <!-- Form -->
              <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" @submit.prevent="send()">
                <div class="form-group mb-0">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="users" name="users" placeholder="Search" type="text">
                  </div>
                </div>
              </form>
              <!-- User -->
              <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        <v-gravatar :email="user.email"/>
                      </span>
                      <div class="media-body ml-2 d-none d-lg-block">
                        <span class="mb-0 text-sm  font-weight-bold">{{ user.email }}</span>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="/logout" class="dropdown-item">
                      <i class="ni ni-user-run"></i>
                      <span>Logout</span>
                    </a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
    </div>
</template>

<script>
import autocomplete from 'autocomplete.js';
import algolia from 'algoliasearch';
export default {
    name: "SearchNav",
    data(){
      return {
        user: ''
      }
    },
    methods: {
      send(){
        return this.$router.push('/user/' + user.id);
      }
    },
    mounted() {
      axios.get('/api/userinfo')
        .then(response => {
            this.user = response.data.data
        })
        .catch(error => {
             if (error.response.status === 404) {
            console.log("errors");
            }
        });

            const index = algolia('R7YZ9JNJ1W', '8bc85169f580ea2a36ee094c2a5718f1').initIndex('users');

            autocomplete('#users', {
                hint: true
            }, {
                source: autocomplete.sources.hits(index, {hitsPerPage: 10}),
                displayKey: 'name',
                templates: {
                    suggestion(suggestion){
                        return '<span><a href="/user/' + suggestion.id + '"><img src="' + suggestion.avatar + '" alt="Gravatar of' + suggestion.name + '" class="mr-2">' 
                        + suggestion.name  + '</a></span>';
                    },
                     empty: '<div class="aa-empty">No people found.</div>'
                }
            }).on('autocomplete:selected', function(suggestion){
                return this.$router.push('/user/' + suggestion.id);
            });
    }
}
</script>