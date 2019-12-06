<template>
    <div>
        <div class="header bg-default pb-8 pt-5 pt-md-8 ">
          <div class="header-body">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Tasks</h5>
                                <span class="h2 font-weight-bold mb-0">{{ taskcount }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <a href="/task/create" class="text-white"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
         <TaskList />
    </div>
</div>
</div>
</template>

<script>
import TaskList from '../components/TaskList';
export default {
    name: 'TaskIndex',
    components: {
        TaskList
    },
    data(){
        return {
            taskcount: '',
        }
    },
    mounted(){
        axios.get('/api/tasks/count')
        .then(response => {
            this.taskcount = response.data.data;
        })
        .catch(error => {
            if (error.response.status === 404) {
                    console.log("errors");
            }
        });
    }
    
}
</script>