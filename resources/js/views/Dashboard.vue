<template>
    <div class="header bg-default pb-8 pt-5 pt-md-8 ">
      <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">
                <User />  
            </div>
            <div class="col-sm-8">
                 <TasksWithFriends />
            </div>
          </div> 
      </div>
    </div>
</template>

<script>
import TasksWithFriends from '../components/TasksWithFriends';
import User from '../components/User';
export default {
    name: "Dashboard",

    components: {
        TasksWithFriends,
        User
    }
}
</script>

