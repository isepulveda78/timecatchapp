<template>
<div class="header bg-default pb-8 pt-5 pt-md-8 ">
    <CreateTaskAndProject />
    <TasksWithFriends />  
</div>
</template>

<script>
import TasksWithFriends from '../components/TasksWithFriends';
import CreateTaskAndProject from '../components/CreateTaskAndProject';
export default {
    name: "Dashboard",

    components: {
        CreateTaskAndProject,
        TasksWithFriends
    }
}
</script>

