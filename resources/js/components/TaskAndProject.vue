<template>
    <div>
    <!-- Header -->
    <div class="header bg-gradient-primary">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-12 col-lg-12">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Tasks</h5>
                        <span class="h2 font-weight-bold mb-0">2</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <a href="/create/task"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import SearchNav from '../components/SearchNav';
    export default {
      name: "TaskAndProject",
    }
</script>
