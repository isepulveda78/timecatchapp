<template>
    <div>
        <div class="header pb-8 pt-5 pt-md-8 ">
            <div class="container-fluid">
                        <div class="card shadow">
                            <div class="card-header border-bottom">
                                <h1 class="mb-0">Create Project</h1>
                            </div>
                            <div class="media-body">
                            <form  class="p-3" autocomplete="off" >
                                <InputField id="project" name="project" label="Project" placeholder="Project Name" @update:field="form.project = $event" :data="form.project"/>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <flat-pickr class="form-control" v-model="form.date"></flat-pickr>
                                </div>
                                
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" v-model="form.notes"></textarea>
                                </div>
                              <div class="form-group">
                                    <label for="billable">Billable</label>
                                    <select class="form-control" id="billable" v-model="form.billable" required>
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
                                    v-model="form.tasks"
                                    placeholder="Add Task"
                                    :options="tasks"
                                    :close-on-select="false">
                                    </multiselect>

                                    <button class="btn btn-danger mt-3" @click.prevent="submitForm">Save</button>
                                </div>
                                    
                                
                            </form>
                        </div>
                        </div>
            </div>
        </div>
    </div>
</template>

<script>
import InputField from '../components/InputField';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
export default {
    name: 'ProjectCreate',
    components: {
        InputField,
        flatPickr
    },

    data() {
        return {
          form: {
            'project': '',
            'billable': '',
            'notes': '',
            'date': '',
            'tasks': []
          },
          tasks: [],
          errors: null
        }
      
    },
    methods: {
         submitForm()
         {
             axios.post('/api/project', this.form)
             .then(response => {
                 this.$router.push('/projects');
             })
             .catch(errors => {
                 console.log("Error");
                 this.errors = errors.response.data.erros;
             });
         }   
    },
    mounted() {
        axios.get('/api/project_tasks')
        .then(response => {
            this.tasks = response.data.data;
        })
        .catch(error => {
            if(error.response.status === 404)
            {
                console.log("errors");
            }
        });
    }
}
</script>