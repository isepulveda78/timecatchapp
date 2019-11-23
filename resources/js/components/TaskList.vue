<template>
    <div class="mt-5">
    <div class="container-fluid">
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
                    <th scope="col"></th>
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
                      {{ task.data.clocked_out }}
                    </td>
                    <td>
                       {{  task.data.clocked_in }}
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
                          <a class="dropdown-item" href="#"><i class="far fa-trash-alt"></i>Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

                    <div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateTask">Update Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                   <div class="form-group">
                                      <label for="name">Name</label>
                                      <input v-model="new_task.name" id="name" type="text" class="form-control" autocomplete="off">
                                      <input v-model="new_task.clocked_in" id="clocked_in" type="text" class="form-control" autocomplete="off">
                                  </div>
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
                                      :close-on-select="false">

                                      </multiselect>
                                  
                                      <button class="btn btn-danger mt-1" @click.prevent="submit">Save</button>
                                  </div>
                                  <hr/>
                                  
                                  <button class="btn btn-default btn-sm mt-1" @click.prevent="clockIn(new_task.id)">Clock In</button>
                                  <button class="btn btn-default btn-sm mt-1" @click.prevent="clockOut(new_task.id)">Clock Out</button>
                           
                            </div>
                        </div>
                    </div>
                  </div>
  
    </div>
</template>

<script>
import TaskInputField from '../components/TaskInputField';
export default {
    name: "TaskList",
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
            new_task: false
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

               name: this.new_task.name

             }).then(response =>{
                $("#updateTask").modal("hide");  
                 console.log(response);
            })
            .catch(errors=>{
                console.log("Error");
                this.errors = errors.response.data.errors;
            });
        },
        clockIn (row)
        {
            this.new_task = row;
            axios.patch('/api/task/' + this.new_task + '/clockin')
            .then(response => {
                $("#updateTask").modal("hide");  
            })
            .catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        },
        clockOut (row)
        {
            this.new_task = row;
            axios.patch('/api/task/' + this.new_task + '/clockout')
            .then(response => {
                $("#updateTask").modal("hide");  
            })
            .catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        }
    },
    mounted()
    {
        axios.get('/api/tasks')
        .then(response => {
            this.tasks = response.data;
        })
        .catch(error => {
            if(this.tasks > 0)
            alert('Unable to fetch contacts.');
        });

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
    },
 
}
</script>