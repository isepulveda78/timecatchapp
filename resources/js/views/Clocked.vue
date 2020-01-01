<template>
    <div class="container-fluid">
      <!-- Table -->
      <div class="row">
        <div class="col mt-5">
          <div class="card shadow mt-5">
            <div class="card-header border-0">
              <div class="row">
                  <div class="col-sm-6">
                      <h3 class="mb-0">Task: {{ task.name }}</h3>
                  </div>
                  <div class="col-sm-6">
                      <button class="btn btn-sm btn-danger float-right mt-0" @click.prevent="calculateTime()">Calculate Time</button>
                      <button class="btn btn-sm btn-default float-right mt-0  mr-1" @click.prevent="clockIn(task.id)">Clock In</button>
                  </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Clocked In Time</th>
                    <th scope="col">Clocked Out Time</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <tr v-for="clock in clocks" :key="clock.id" :row="clock">
                        <td>
                            {{ clock.clocked_in }}
                        </td>
                        <td>
                            {{ clock.clocked_out }}
                        </td>
                        <td>
                            <div class="badge badge-dot mr-4">
                                <button class="btn btn-sm btn-default" @click.prevent="clockOut(clock.id)">Clock Out</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
              </table>
            </div>
                   
            <div class="card-footer py-4">
              <nav aria-label="pagination">
          
              </nav>
            </div>
          </div>

    </div>
      </div>
    </div>
</template>

<script>
export default {
    name: 'Clocked',
    data()
    {
        return{
            task: '',
            clocks: '',
        }
    },
    methods: {
        clockIn()
        {
            axios.post('/api/clock', 
            {task_id: this.task.id} )
            .then(response => {
                this.clock = response.data.data;
            })
            .catch(errors=>{
                this.errors = errors.response.data.errors;
            });
        },
        clockOut(row)
        {
            axios.patch('/api/clock/' + row,
            {task_id: this.task.id} )
            .then(response => {
                this.$router.push('/tasks');
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        calculateTime()
        {
          axios.patch('/api/task/calculate_task/' + this.$route.params.id)
          .then(response => {
            this.task = response.data.data;
          })
          .catch(error => {
             if(this.tasks > 0)
            alert('Unable to fetch tasks.');
          });
        }
    },
    mounted()
    {
      axios.get('/api/task/taskWithFriends/' + this.$route.params.id)
        .then(response => {
           this.task = response.data.data;
        })
        .catch(error => {
            if(this.tasks > 0)
            alert('Unable to fetch tasks.');
        });

      axios.get('/api/task/' + this.$route.params.id + '/clocks')
      .then(response => {
          this.clocks = response.data;
      })
      .catch(error => {
           if(this.tasks > 0)
            alert('Unable to fetch time.');
      });
    }
  }
</script>