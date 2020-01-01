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
        viewTask(row)
        {
          return this.$router.push('/clocked/' + row);
        }
     },
    mounted(){
        this.getTasks();
    }
}
</script>