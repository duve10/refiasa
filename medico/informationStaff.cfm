<cfinclude template="security.cfm">


<cfset active = 3>
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
                                <h1 class="h3 mb-3"><cfoutput><strong>Staff</strong></cfoutput> </h1>
                            </div>

                    </div>




                    <div class='row'>
                        <div class="col-12">
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row'>
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