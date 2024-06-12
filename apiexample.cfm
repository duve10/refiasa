<cfparam  name="drawn" default='0'>
<cfparam  name="start" default='0'>
<cfparam  name="length" default='10'>

<cfparam  name="user" default=''>
<cfparam  name="registered" default=''>

<cfset returnStructClinical = StructNew() />
<cfset returnStructClinical['data'] = [] />
<cfset returnStructClinical['drawn'] = drawn />
<cfset returnStructClinical['recordsTotal'] = 0 />
<cfset returnStructClinical['recordsFiltered'] = 0 />


<cfparam  name="indexColumn" default=''>
<cfparam  name="orderName" default=''>
<cfparam  name="columnName" default=''>


<cfset indexColumn = form["order[0][column]"]>
<cfset orderName = form["order[0][dir]"]>
<cfset columnName = form["columns[#indexColumn#][data]"]>


<cfquery name="totalQuery" datasource="#dbAcademic#">
    SELECT 
        T1.LOGIN
    FROM
        STAFF T1
    LEFT JOIN 
        CLINICAL_INFORMATION_DETAILS T2 ON T2.codigo_user = T1.STAFF_ID AND T2.TYPE_USER = 'STAFF'
     WHERE T1.STATUS = 'A' AND T1.LOGIN IS NOT NULL
    <cfif registered EQ '1'>
        AND T2.user_creation IS NOT NULL
    </cfif>
    <cfif registered EQ '2'>
        AND T2.user_creation IS NULL
    </cfif>
    GROUP BY T1.LOGIN
</cfquery>

<cfset returnStructClinical['recordsTotal'] = totalQuery.recordCount />
<cfset returnStructClinical['recordsFiltered'] = totalQuery.recordCount />


<cfquery name="getUsers" datasource="#dbAcademic#">

    SELECT 
        T1.STAFF_ID,
        T2.USER_CREATION, 
        T1.FULLNAME,
        T1.LOCAL,
        T1.TYPE,
        (
            CASE
                WHEN T1.TYPE = 'A' OR T1.TYPE = 'P' THEN T3.DEPARTMENT_TITLE_EN
                ELSE '-' END
        ) AS DEPARTMENTNAME,
        MAX(T2.DATE_CREATION) AS DATE_CREATED
    FROM STAFF  T1
    LEFT JOIN 
        CLINICAL_INFORMATION_DETAILS T2 ON T2.codigo_user = T1.STAFF_ID AND T2.TYPE_USER = 'STAFF'
    LEFT JOIN 
        MARKHAM2024..STAFF_DEPARMENT T3 ON T3.DEPARTMENT_ID = T1.STAFF_DEPARMENT_ID
    WHERE T1.STATUS = 'A' AND T1.LOGIN IS NOT NULL
    <cfif registered EQ '1'>
        AND T2.user_creation IS NOT NULL
    </cfif>
    <cfif registered EQ '2'>
        AND T2.user_creation IS NULL
    </cfif>
    GROUP BY T1.STAFF_ID,T2.USER_CREATION, T1.FULLNAME ,T1.LOCAL, T1.TYPE, T3.DEPARTMENT_TITLE_EN
    ORDER BY
    <cfif indexColumn EQ 0>
        T1.FULLNAME #orderName#
    <cfelseif indexColumn EQ 1>
        T1.LOCAL #orderName#
    <cfelseif indexColumn EQ 2>
        T1.TYPE #orderName#
    <cfelseif indexColumn EQ 3>
        (
            CASE
                WHEN T1.TYPE = 'A' OR T1.TYPE = 'P' THEN T3.DEPARTMENT_TITLE_EN
                ELSE '-' END
        ) #orderName#
    <cfelseif indexColumn EQ 4>
        DATE_CREATED #orderName#
    </cfif>

    <cfif length NEQ '-1'>
        OFFSET #start# ROWS 
        FETCH NEXT (#length#) ROWS ONLY;
    </cfif>
    
</cfquery>

<cfloop query="getUsers">
    <cfset returnStructOne = StructNew() />
    <cfset returnStructOne["FULLNAME"] = '#FULLNAME#' />
    <cfset returnStructOne["USER_CREATION"] = '#USER_CREATION#' />

    <cfset dateString = '#DATE_CREATED#'>
    <cfset actionString = '<p class="fs-6 fw-bold text-success m-0">Completed</p>'>



    <cfset stringSend = ''>
    <cfif DATE_CREATED EQ ''>
        <cfset dateString = '-'>


        <cfquery name="selectSend" datasource="#dbAcademic#">
            SELECT TOP 1 T1.DATE_SEND FROM CLINICAL_INFORMATION_REMINDER T1
            WHERE T1.CODIGO_USER = '#STAFF_ID#' ORDER BY T1.DATE_SEND DESC 
        </cfquery>

        <cfif selectSend.RECORDCOUNT GT 0>
            <cfset actionString = '<button id="btn#staff_id#" type="button" class="btn btn-danger" data-name="#FULLNAME#" data-id="#staff_id#">ReSend</button>' >
            <cfset stringSend = "#dateFormat(selectSend.DATE_SEND,'dd-mm-yyyy')# #timeFormat(selectSend.DATE_SEND,'hh:nn tt')#">
        <cfelse>
            <cfset actionString = '<button id="btn#staff_id#" type="button" class="btn btn-warning" data-name="#FULLNAME#" data-id="#staff_id#">Send</button>' >
        </cfif>



    </cfif>
    <cfset returnStructOne["DATE_CREATED"] = '#dateString#' />

    <cfset stringLocal = ''>
    <cfswitch expression = "#local#"> 
        <cfcase value="U">
            <cfset stringLocal = 'SS'>
        </cfcase>
        <cfcase value="L">
            <cfset stringLocal = 'PS'>
        </cfcase>
        <cfcase value="E">
            <cfset stringLocal = 'EY'>
        </cfcase>
    </cfswitch>
    <cfset returnStructOne["LOCAL"] = '#stringLocal#' />

   
    <cfset returnStructOne["department"] = '#DEPARTMENTNAME#' />
    <cfset returnStructOne["action"] = actionString/>


    <cfset returnStructOne["TYPE"] = TYPE/>
    <cfset returnStructOne["dateSend"] = '<div id="#STAFF_ID#" class="h5">#stringSend#<div>'/>

    <cfset ArrayAppend(returnStructClinical['data'],returnStructOne) />
</cfloop>


<cfscript>
    writeOutput(serializeJSON(returnStructClinical));
</cfscript>