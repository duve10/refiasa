
<cfif SESSION.domain NEQ 'staff'>
    <cfabort>
</cfif>

<cfset access_SEC  = "">
<cfset access_FREE = "anderson.romero;jorge.rozas;lorena.cordova;judy.cooper;marco.bassino;bruno.landa;">

<cfset txtAccess = access_FREE & access_SEC >
<cfif !isLogin(txtAccess)>
    You do not have access
    <cfabort>
</cfif>