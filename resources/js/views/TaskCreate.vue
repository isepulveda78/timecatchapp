<template>
<div>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 ">
        <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Add Task</h3>
                        </div>
                        <div class="media-body">
                            <form @submit.prevent="submitForm" class="p-3" autocomplete="off">
                                <TaskInputField id="name" name="name" label="Task Name" placeholder="Task Name" @update:field="form.name = $event" :error="errors"/>
                                <div v-if="this.form.name.length > 0">
                                        <button class="btn btn-danger mt-1" type="submit">Create Task</button>
                                </div>
                                <div v-else-if="this.form.name.length === 0"></div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
</div>
</template>

<script>
import TaskInputField from '../components/TaskInputField';
export default {
    name: 'TaskCreate',

    components: {
        TaskInputField
    },

    data: function()
    {
        return {
            form: {
                'name': ''
                 
            },
            errors: null

        }
    },
    methods: {
        submitForm: function()
        {
             axios.post('/api/task', this.form)
            .then(response =>{
                this.$router.push('/tasks');
            })
            .catch(errors=>{
                this.errors = errors.response.data.errors;
            });
        }
    },
}
</script>