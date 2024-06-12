<cfinclude template="security.cfm">


<cfset active = 1>
<cfinclude template="includes/header.cfm">

<body>
    <div class='wrapper'>
        <cfinclude template="includes/sidebar.cfm">
        <div class='main'>
            <cfinclude template="includes/navbar.cfm">


            <main class='content'>
                <div class='container-fluid p-0'>

                    <div class="row mb-2 mb-xl-3">
                            <div class="col-auto d-none d-sm-block">
                                <h1 class="h3 mb-3"><strong>Welcome</strong><cfoutput> #name# #lastName#</cfoutput> </h1>
                            </div>

                            <!----<div class="col-auto ms-auto text-end mt-n1">
                                <a class="btn btn-primary btnColorGeneral" href="incidentForm.cfm" >
                                    + Add Event
                                </a>
                            </div>---->
                    </div>




                    <div class='row'>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Events</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="alert-octagon"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">100 event(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 50 events  </span>
										<span class="text-muted">Since last month</span>
									</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
							<div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                             <h5 class="card-title">Active Events</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                            <i class="align-middle" data-feather="check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">20 event(s)</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> +20 events </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                    
                        <div class="col-12">
                            <div class="card">
                    
                                <div class="card-body">
                                    <div class="chart w-100">
                                        <div id="eventsByMonth">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

               
                    </div>



                </div>
            </main>
        </div>
    </div>

    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/clinicalMedico.js"></script>
</body>

</html>