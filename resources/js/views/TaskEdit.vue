<template>
<div>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 ">
        <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Add Task</h3>
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
                                <hr/>
                                <input type="hidden" name="id" id="id" :data="form.id">
                                <button class="btn btn-default btn-sm mt-1" @click.prevent="clockIn">Clock In</button>
                                <button class="btn btn-default btn-sm mt-1" @click.prevent="clockOut">Clock Out</button>


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
    name: 'TaskEdit',

    components: {
        TaskInputField
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
    mounted()
    {
            axios.get('/api/task/' + this.$route.params.id)
                .then(response => {
                    this.form = response.data.data;

                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;

                    if (error.response.status === 404) {
                        this.$router.push('/tasks');
                    }
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
    methods: {
        submitForm: function()
        {
             axios.patch('/api/task/' + this.$route.params.id, this.form)
            .then(response =>{
                console.log(response);
                //this.$router.push('/tasks');
            })
            .catch(errors=>{
                console.log("Error");
                this.errors = errors.response.data.errors;
            });
        },
        clockIn: function()
        {
            axios.patch('/api/task/' + this.$route.params.id + '/clockin', this.form)
            .then(response => {
                this.$router.push('/tasks');
            })
            .catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        },
        clockOut: function()
        {
            axios.patch('/api/task/' + this.$route.params.id + '/clockout', this.form)
            .then(response => {
                this.$router.push('/tasks');
            })
            .catch(errors => {
                this.errors = errors.reponse.data.errors;
            });
        }

    }
}
</script>