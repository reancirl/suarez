@extends('layouts.pdf')

@section('content')


<div class="text-center" style="padding-top: 30px">
   	<h5><b>REPUBLIC OF THE PHILIPPINES</b></h5>
   	<div class="small">BARANGAY SUAREZ</div>
   	<div class="small">Iligan City</div>
   	<div><b>OFFICE OF THE PUNONG BARANGAY</b></div>

   	<h1 style="margin-top:2rem;font-size:1.5rem;">
        <b>
            @if($appointment->document_type == 'brgy_cert')
                BARANGAY CLEARANCE CERTIFICATION
            @else
                CERTIFICATE OF INDEGENCY
            @endif
        </b>
    </h1>
</div>
<div style="padding-left:3rem;padding-top:5rem;">
    <div class="small" style="font-size:1.2rem;">TO WHOM IT MAY CONCERN:</div>
    <div class="small" style="padding-top:1.5rem;font-size:1.2rem;">
        This is to certify that <u><b>{{ $appointment->resident->full_name }} </b></u>, <u><b>{{ $appointment->resident->age }} </b></u> years old
        {{ ucWords($appointment->resident->civil_status) }} a bonafide resident of {{ $appointment->resident->zone->name }}, Suarez, Iligan City.
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1.2rem;">
        This is to certify that no derogatory record has been filed against him/her in this office
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1.2rem;">
        This certification is being issued upon the request of the above named person for <u><b>{{ ucWords($appointment->purpose) }} </b></u>
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1.2rem;">
        Issued and done this on <u><b>{{ date('M d, Y',strtotime($appointment->date_issued)) }} </b></u>.
    </div>

    <h1 style="font-size:1.4rem;margin-top:4rem;"><b>___________________________</b></h1>
    <h1 style="font-size:1.4rem;"><b>APPLICANT SIGNATURE</b></h1>

    <h1 style="font-size:1.2rem;margin-top:4rem;"><b>MARCELINO A. GELLICA JR.</b></h1>
    <h1 style="font-size:1.4rem;"><b>PUNONG BARANGAY</b></h1>
</div>


<div class="page-break"></div>


@endsection