<template>
   <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 ">
        <div class="container-fluid">
          <div class="header-body">
                <TaskAndProject />
                <TaskList endpoint="/api/tasks" />
          </div>
        </div>
   </div>
</template>

<script>
import TaskAndProject from "../components/TaskAndProject";
import TaskList from '../components/TaskList';
export default {
    name: "TasksIndex",

    components: {
        TaskList,
        TaskAndProject
    }
}
</script>