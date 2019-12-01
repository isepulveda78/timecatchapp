<template>
<div>
    <div class="header bg-default pb-8 pt-5 pt-md-8 ">
        <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header border-bottom">
                            <h1 class="mb-0">Add Task</h1>
                        </div>
                        <div class="media-body">
                            <form  class="p-3" autocomplete="off">
                                <TaskInputField id="name" name="name" label="Task Name" placeholder="Task Name" @update:field="form.name = $event" :data="form.name"/>
                                <div v-if="formEditMode">
                                    <multiselect 
                                    id="friends"
                                    :multiple="true"
                                    :hide-selected="true"
                                    label="name"
                                    track-by="id"
                                    v-model="form.friends"
                                    placeholder="Add friends"
                                    :options="friends"
                                    :close-on-select="false">

                                    </multiselect>
                                
                                    <button class="btn btn-danger mt-1" @click="submitForm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             <TaskList />
        </div>  
</div>


</template>

<script>
import TaskInputField from '../components/TaskInputField';
import TaskList from '../components/TaskList';
export default {
    name: 'TaskEdit',

    components: {
        TaskInputField,
        TaskList
    },

    data: function()
    {
        return {
            form: {
                'name': '',
                'id': '',
                'friends': [],
            },
            friends: [],
            errors: null

        }
    },
    computed: {
        formEditMode: function() {
            return this.form.name.length > 0;
        }
    },
    methods: {
        submitForm()
        {
             axios.post('/api/task', this.form)
            .then(response =>{
                this.$router.push('/tasks');
            })
            .catch(errors=>{
                console.log("Error");
                this.errors = errors.response.data.errors;
            });
        }
    },
    mounted() {
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