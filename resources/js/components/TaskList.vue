<template>
    <div>

    <div class="container-fluid mt-5">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Tasks</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Task</th>
                    <th scope="col">Time Clocked In</th>
                    <th scope="col">Time Clocked Out</th>
                    <th scope="col">Users</th>
                    <th scope="col">Completion</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody >
                  <tr v-for="task in tasks" :key="task.id" :row="task">
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ task.data.name }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{ task.data.clocked_in | moment("dddd, h:mm:ss a")}}
                    </td>
                    <td>
                       {{  task.data.clocked_out | moment("dddd, h:mm:ss a")}}
                    </td>
                    <td>
                      <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                          IS
                        </a>
                      </div>
                    </td>
                    <td v-if="task.data.clocked_in && task.data.clocked_out">
                       <span class="badge badge-dot mr-4">
                        <i class="bg-success"></i> Completed
                      </span>
                    </td>
                      <td v-else>
                       <span class="badge badge-dot mr-4">
                        <i class="bg-danger"></i> Pending
                      </span>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a href="#" @click.prevent="loadUpdateModal(task.data)" class="dropdown-item" data-toggle="modal" data-target="#updateTask"><i class="fas fa-pencil-alt"></i>Edit</a>
                          <a class="dropdown-item" href="#" @click.prevent="deleteTask(task.data.id)"><i class="far fa-trash-alt"></i>Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="pagination">
                <pagination :meta="meta" v-on:pagination:switched="getTasks"></pagination>
              </nav>
            </div>
          </div>
        </div>
      </div>
    

                    <div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                                        
                        <div class="modal-header border-bottom">
                            <h1 class="modal-title" id="modal-title-default">Edit Task</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                      
                            <div class="modal-body">
                                   <div class="form-group">
                                        <label for="name">Name</label>
                                        <input v-model="new_task.name" id="name" name="name" type="text" class="form-control" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                       <label for="clocked_in">Clocked In</label>
                                       <input v-model="new_task.clocked_in" id="clocked_in" type="text" placeholder="Need to clock in" class="form-control mt-2" autocomplete="off" disabled>
                                    </div>

                                    <div class="form-group">
                                       <label for="clocked_in">Clocked Out</label>
                                        <input v-model="new_task.clocked_out" id="clocked_out" type="text" placeholder="Need to clock out" class="form-control mt-2" autocomplete="off" disabled>
                                    </div>
                              
                                  <div class="form-group">
                                  <label for="friends">Users in Task</label>
                                  <div v-if="formEditMode(new_task)">
                                      <multiselect 
                                      id="friends"
                                      :multiple="true"
                                      :hide-selected="true"
                                      label="name"
                                      track-by="id"
                                      v-model="new_task.friends"
                                      placeholder="Add friends"
                                      :options="friends"
                                      :close-on-select="false"
                                      :disabled="false">

                                      </multiselect>
                                      <button class="btn btn-danger mt-2" @click.prevent="submit">Save</button>
                                    </div>
                                  </div>
                                 </div>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="modal-footer border-top">
                                        <div v-if="!new_task.clocked_in">
                                            <button class="btn btn-default btn-sm mt-1" @click.prevent="clockIn(new_task.id)">Clock In</button>&nbsp;
                                        </div>
                                        <div v-if="new_task.clocked_in && !new_task.clocked_out > 0">
                                           <button class="btn btn-default btn-sm mt-1" @click.prevent="clockOut(new_task.id)">Clock Out</button>
                                           
                                        </div>
                                        <div v-if="new_task.clocked_in && new_task.clocked_out">
                                            <h6 class="modal-title badge badge-success">Completed</h6>
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
import Pagination from '../components/Pagination';
export default {
    name: "TaskList",
    components: {
      Pagination
    },
    props: ['row'],
    data ()
    {
        return {
            task: {
                name: '',
                friends: '',
            },
            tasks: [],
            friends: [],
            new_task: false,
            delete_task: false,
            meta: {}
        }
    },
    
    methods: {
        loadUpdateModal(row)
         {
            this.new_task = row;
            $("#updateTask").modal("show");  
        },
        formEditMode(task) {
            if(task) {
              return task.name.length > 0;
            } else {
              return false;
            }
            
        },
       submit ()
        {
            axios.patch('/api/task/' + this.new_task.id , {
               name: this.new_task.name,
               friends: this.new_task.friends
             }).then(response =>{
                $("#updateTask").modal("hide");
                this.resetData();
            }).catch(errors=>{
                console.log("Error");
                this.errors = errors.response.data.errors;
            });
        },
        clockIn ()
        {
            axios.patch('/api/task/' + this.new_task.id + '/clockin', {
              clocked_in: this.new_task.clocked_in
            }).then(response => {
                $("#updateTask").modal("hide");
                 this.$router.push('/tasks');
            }).catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        },
        clockOut ()
        {
            axios.patch('/api/task/' + this.new_task.id + '/clockout', {
              clocked_out: this.new_task.clocked_out
            }).then(response => {
                $("#updateTask").modal("hide");  
                 this.$router.push('/tasks');
            })
            .catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        },
        resetData(){
            this.task.name = '';
            this.task.friends = '';
        },
        deleteTask(row)
        {
          axios.delete('/api/task/' + row)
          .then(response => {
             this.$router.push('/tasks');
          })
        .catch(error => {
          alert('Internal Error. Unable to delete task.');

          if(error.response.status === 404)
              {
                  this.$router.push('/tasks');
            }
          });
        },
        getTasks(page = 1)
        {
          axios.get('/api/tasks', {
            params: {
              page
            }
          })
        .then(response => {
            this.tasks = response.data.data;
           this.meta = response.data.meta;
        })
        .catch(error => {
            if(this.tasks > 0)
            alert('Unable to fetch tasks.');
        });
        }
    },
    mounted()
    {  
     
        this.getTasks();

        axios.get('/api/friends')
          .then(response => {
                    this.friends = response.data.data;

                    this.loading = false;
        })
        .catch(error => {
            this.loading = false;

        if (error.response.status === 404) {
            console.log("errors");
            }
        });
    }
 
}
</script>