<template>
    <div>
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 ">
            <div class="container-fluid">
                        <div class="card shadow">
                            <div class="card-header border-bottom">
                                <h1 class="mb-0">Create Project</h1>
                            </div>
                            <div class="media-body">
                            <form  class="p-3" autocomplete="off" >
                                <TaskInputField id="project" name="project" label="Project" placeholder="Project Name" @update:field="form.project = $event" :data="form.project"/>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <datetime input-class="form-control" type="date" input-id="date" name="date" v-model="form.date"></datetime>
                                </div>
                                
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" v-model="form.notes"></textarea>
                                </div>
                                <div class="row">
                                    <P class="ml-3">Billable:&nbsp;</p>
                                <div class="form-check mr-5">
                                        <label class="form-check-label" for="billable">
                                        <b>Yes</b>
                                        </label>
                                        <input class="ml-2 form-check-input" type="checkbox" value="Yes" id="billable" name="billable" v-model="form.billable">
                                </div>
                                <div class="form-check">
                                       <label class="form-check-label" for="billable">
                                        <b>No</b>
                                        </label>
                                        <input class="ml-2 form-check-input" type="checkbox" value="No" id="billable" name="billable">
                                </div>
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
            <ProjectList />
        </div>
    </div>
</template>

<script>
import TaskInputField from '../components/TaskInputField';
import ProjectList from '../components/ProjectList';
export default {
    name: 'ProjectCreate',
    components: {
        TaskInputField,
        ProjectList
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