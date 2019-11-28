<template>
    <div>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 ">
          <div class="header-body">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Projects</h5>
                                <span class="h2 font-weight-bold mb-0">2</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <a href="/project/create"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    <ProjectList />
   </div>
        
    </div>
</div>
</template>

<script>
import CreateTaskAndProject from '../components/CreateTaskAndProject';
import ProjectList from '../components/ProjectList';
export default {
    name: 'ProjectIndex',

    components: {
        ProjectList,
        CreateTaskAndProject
    }
}
</script>