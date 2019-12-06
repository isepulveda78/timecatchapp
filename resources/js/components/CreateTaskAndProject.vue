<template>
    <div>
    <!-- Header -->
    <div class="header bg-default">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Tasks</h5>
                        <span class="h2 font-weight-bold mb-0">{{ taskcount }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <a href="/task/create" class="text-white"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
        
    
              <div class="col-xl-6 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Projects</h5>
                        <span class="h2 font-weight-bold mb-0">{{ projectcount }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <a href="/project/create" class="text-white"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
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
export default {
    name: 'CreateTaskAndProject',
     data(){
        return {
            taskcount: '',
            projectcount: '',
        }
    },
    mounted(){
        axios.get('/api/tasks/count')
        .then(response => {
            this.taskcount = response.data.data;
        })
        .catch(error => {
            if (error.response.status === 404) {
                    console.log("errors");
            }
        });
        axios.get('/api/projects/count')
        .then(response => {
            this.projectcount = response.data.data;
        })
        .catch(error => {
            if (error.response.status === 404) {
                    console.log("errors");
            }
        });
    }
}
</script>