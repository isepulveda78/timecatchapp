<template>
     <div>
      <!-- Table -->
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Assigned Tasks</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Task</th>
                    <th scope="col">Time Clocked In</th>
                    <th scope="col">Time Clocked Out</th>
                    <th scope="col">Completion</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody >
                  <tr v-for="task in tasksWithFriends" :key="task.id" :row="task">
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
                          <a href="#" @click.prevent="viewTask(task.data.id)" class="dropdown-item"><i class="fas fa-eye"></i>View</a>
                          <a href="#" @click.prevent="loadUpdateModal(task.data)" class="dropdown-item" data-toggle="modal" data-target="#updateTask"><i class="fas fa-clock"></i>Clock In - Clock Out</a>
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
        
      
    

                    <div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                                        
                        <div class="modal-header border-bottom">
                            <h1 class="modal-title" id="modal-title-default">Clock In - Clock Out</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                      
                            <div class="modal-body">
                                   <div class="form-group">
                                        <label for="name">Name</label>
                                        <input v-model="show.name" id="name" name="name" type="text" class="form-control" autocomplete="off" disabled>
                                    </div>

                                    <div class="form-group">
                                       <label for="clocked_in">Clocked In</label>
                                       <input v-model="show.clocked_in" id="clocked_in" type="text" placeholder="Need to clock in" class="form-control mt-2" autocomplete="off" disabled>
                                    </div>

                                    <div class="form-group">
                                       <label for="clocked_in">Clocked Out</label>
                                        <input v-model="show.clocked_out" id="clocked_out" type="text" placeholder="Need to clock out" class="form-control mt-2" autocomplete="off" disabled>
                                    </div>
                              
                                  <div class="form-group">
                                  <label for="friends">Users in Task</label>
                                  <div>
                                      <multiselect 
                                      id="friends"
                                      :multiple="true"
                                      :hide-selected="true"
                                      label="name"
                                      track-by="id"
                                      v-model="show.friends"
                                      placeholder="Add friends"
                                      :options="friends"
                                      :close-on-select="false"
                                      :disabled="true">

                                      </multiselect>
                                      <button class="btn btn-danger mt-2" @click.prevent="submit">Save</button>
                                    </div>
                                  </div>
                                 </div>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="modal-footer border-top">
                                        <div v-if="!show.clocked_in">
                                            <button class="btn btn-default btn-sm mt-1" @click.prevent="clockInFriend(show.id)">Clock In</button>&nbsp;
                                        </div>
                                        <div v-if="show.clocked_in && !show.clocked_out > 0">
                                           <button class="btn btn-default btn-sm mt-1" @click.prevent="clockOutFriend(show.id)">Clock Out</button>
                                           
                                        </div>
                                        <div v-if="show.clocked_in && show.clocked_out">
                                            <h6 class="modal-title badge badge-success">Completed</h6>
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
    name: 'TasksWithFriends',
    components: {
      Pagination
    },
    data() {
        return {
            task: {
                name: '',
                friends: '',
                clocked_in: '',
                clocked_out: '',
            },
            friends: [],
            show: false,
            meta: {},
            tasksWithFriends: {},
            clocked_in: '',
            clocked_out: '',
        }
    },
    methods: {
    loadUpdateModal(row)
    {
        this.show = row;
        $("#updateTask").modal("show");  
    },
    getTasks(page = 1)
        {
          axios.get('/api/tasks/tasksWithFriends', {
            params: {
              page
            }
          })
        .then(response => {
           this.tasksWithFriends = response.data.data;
            this.meta = response.data.meta;
        })
        .catch(error => {
            if(this.tasks > 0)
            alert('Unable to fetch tasks.');
        });
        },
        clockInFriend (row)
        {
            axios.patch('/api/task/' + this.show.id + '/clockin', {
                clocked_in: this.show.clocked_in
            }).then(response => {
                $("#updateTask").modal("hide");
                 this.$router.push('/clocked/' + row);
            }).catch(errors => {
                this.errors = errors.reponse;
            });
        },
        clockOutFriend (row)
        {
            axios.patch('/api/task/' + this.show.id + '/clockout', {
                clocked_out: this.show.clocked_out
            }).then(response => {
                $("#updateTask").modal("hide");
                 this.$router.push('/clocked/' + row);  
            })
            .catch(errors => {
                this.errors = errors.reponse;
            });
        },
        viewTask(row)
        {
          return this.$router.push('/clocked/' + row);
        }
     },

    mounted(){
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