<template>
<div class="header bg-default pb-8 pt-5 pt-md-8"> 
    <div class="container-fluid mt-5">

    <div class="card shadow">
        <div class="card-header border-bttom">
            <h3 class="mb-0">Build TimeCatch</h3>
            </div>
            <div class="row mt-2 p-5">
                <div class="col-sm-6">
                <div class="card bg-gradient-default">
                    <!-- Card body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Time</h5>
                             <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">3 hours</span>
                                <span class="text-nowrap text-light">3 minutes</span>
                            </p>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-default text-white border rounded-circle shadow">
                            <i class="fas fa-clock"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card bg-gradient-default mt-1">
                    <!-- Card body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Billable</h5>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">Yes</span>
                            </p>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-default text-white border rounded-circle shadow">
                            <i class="far fa-money-bill-alt"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            

                <div class="col-sm-6">
                <div class="card bg-gradient-default">
                    <!-- Card body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Date</h5>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">July 12, 1978</span>
                            </p>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-default text-white border rounded-circle shadow">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="card bg-gradient-default mt-1">
                    <!-- Card body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Notes</h5>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">Yes</span>
                            </p>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-default text-white border rounded-circle shadow">
                            <i class="fas fa-clock"></i>
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
export default {
    name: 'ProjectSummary'
}
</script>