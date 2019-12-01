<template>
  <div class="container-fluid mt-5">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Projects</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Project</th>
                    <th scope="col">Tasks</th>
                    <th scope="col">Billable</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="project in projects" :key="project.id" :row="project">
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ project.data.date |  moment("dddd, MMMM Do YYYY")}}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{ project.data.project }}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        Tasks
                      </span>
                    </td>
                    <td>
                      <div class="badge badge-dot mr-4">
                        {{ project.data.billable }}
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">{{ project.data.notes }}</span>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                           <a href="#" @click.prevent="loadProjectModal(project.data)" class="dropdown-item" data-toggle="modal" data-target="#updateProject"><i class="fas fa-pencil-alt"></i>Edit</a>
                           <a class="dropdown-item" href="/projectsummary"><i class="fas fa-plus"></i>Project Summary</a>
                            <a class="dropdown-item" href="#" @click.prevent="deleteProject(project.data.id)"><i class="far fa-trash-alt"></i>Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
                   
            <div class="card-footer py-4">
              <nav aria-label="pagination">
               <pagination :meta="meta" v-on:pagination:switched="getProjects"></pagination>
              </nav>
            </div>
          </div>



    <div class="modal fade" id="updateProject" tabindex="-1" role="dialog" aria-labelledby="updateProject" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
                                        
      <div class="modal-header border-bottom">
          <h1 class="modal-title" id="modal-title-default">Edit Project</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>

            <div class="modal-body">               
                <div class="form-goup">
                  <label for="project">Project Name</label>
                  <input class="form-control" id="project" name="project" label="Project" placeholder="Project Name" v-model="new_project.project"/>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <datetime input-class="form-control" format="" type="date" input-id="date" name="date" v-model="new_project.date"></datetime>
                </div>
                                
                  <div class="form-group">
                      <label for="notes">Notes</label>
                      <textarea class="form-control" id="notes" name="notes" rows="3" v-model="new_project.notes"></textarea>
                  </div>

                    <div class="form-group">
                        <label for="billable">Billable</label>
                        <select class="form-control" id="billable" v-model="new_project.billable" required>
                        <option disabled value="">Select your option</option>
                        <option>Yes</option>
                        <option>No</option>
                        </select>
                    </div>
                        
                        <div class="form-group">
                            <label for="notes">Add Tasks</label>
                            <multiselect 
                              id="tasks"
                              :multiple="true"
                              :hide-selected="true"
                              label="name"
                              track-by="id"
                              v-model="new_project.tasks"
                              placeholder="Add Task"
                              :options="tasks"
                              :close-on-select="false">
                            </multiselect>

                            <button class="btn btn-danger mt-3" @click.prevent="submit">Save</button>
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
import Pagination from '../components/Pagination';

export default {
    name: 'ProjectList',
    components: {
      Pagination,
    },
    data(){
        return {
            project: {
                project: '',
                date: '',
                billable: '',
                notes: '',
                tasks: []
            },
            projects: [],
            tasks: [],
            new_project: false,
            delete_project: false,
            meta: {}
        }
    },
    methods: {

      loadProjectModal(row)
         {
            this.new_project = row;
            $("#updateProject").modal("show");  
        },
      submit ()
        {
            axios.patch('/api/project/' + this.new_project.id , {
               project: this.new_project.project,
               notes: this.new_project.notes,
               billable: this.new_project.billable,
               date: this.new_project.date

             }).then(response =>{
                $("#updateProject").modal("hide");
                this.resetData();
            }).catch(errors=>{
                console.log("Error");
                this.errors = errors.response.data.errors;
            });
        },
        deleteProject(row)
        {
          axios.delete('/api/project/' + row)
          .then(response => {
             this.$router.push('/projects');
          })
        .catch(error => {
          alert('Internal Error. Unable to delete project.');

          if(error.response.status === 404)
              {
                  this.$router.push('/projects');
            }
          });
        },
      getProjects(page = 1)
        {
          axios.get('/api/projects', {
            params: {
              page
            }
          })
        .then(response => {
            this.projects = response.data.data;
           this.meta = response.data.meta;
        })
        .catch(error => {
            if(this.projects > 0)
            alert('Unable to fetch prjects.');
        });
        }
    },
    mounted()
    {
      this.getProjects();

          axios.get('/api/project_tasks')
          .then(response => {
            this.tasks = response.data.data;     
        }).catch(error => {
            this.loading = false;

        if (error.response.status === 404) {
            console.log("errors");
            }
        });
    }
    
}

</script>