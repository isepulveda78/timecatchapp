<template>
<div class="header bg-default pb-8 pt-5 pt-md-8 "> 
    <CreateTaskAndProject />
    <ProjectList />
    <TaskList />      
</div>
</template>

<script>
import CreateTaskAndProject from '../components/CreateTaskAndProject';
import TaskList from '../components/TaskList';
import ProjectList from '../components/ProjectList';
export default {
    name: "Dashboard",

    components: {
        CreateTaskAndProject,
        TaskList,
        ProjectList
    }
}
</script>

