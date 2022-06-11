@extends('layouts.pdf')

@section('content')


<div class="text-center" style="padding-top: 30px">
    <div style=";">
        <img src="{{ asset('img/suarez_logo.png') }}" alt="suarez-seal" style="object-fit:contain;width:15rem;height:10rem;margin-left:3rem;">
        <div style="margin-top:-8rem;">
            <h5><b>REPUBLIC OF THE PHILIPPINES</b></h5>
            <div class="small">BARANGAY SUAREZ</div>
            <div class="small">Iligan City</div>
            <div><b>OFFICE OF THE PUNONG BARANGAY</b></div>
        </div>
    </div>
    
    @if($appointment->document_type == 'brgy_cert')
        <h1 style="margin-top:4rem;font-size:1.5rem;">
            <b>
                BARANGAY CLEARANCE CERTIFICATION
            </b>
        </h1>
    @else
        <h1 style="margin-top:3rem;font-size:2rem;letter-spacing:.4rem;">
            <b>
                CERTIFICATION
            </b>
        </h1>
    @endif
</div>
<div style="padding-left:4.5rem;padding-right:4.5rem;padding-top:4rem;">
    <div class="small" style="font-size:1rem;">TO WHOM IT MAY CONCERN:</div>
    <div class="small" style="padding-top:1.5rem;font-size:1rem;">
        This is to certify that <u><b>{{ $appointment->resident->full_name }} </b></u>, <u><b>{{ $appointment->resident->age }} </b></u> years old
        {{ ucWords($appointment->resident->civil_status) }} a bonafide resident of {{ $appointment->resident->zone->name }}, Suarez, Iligan City.
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1rem;">
        This is to certify that no derogatory record has been filed against him/her in this office
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1rem;">
        This certification is being issued upon the request of the above named person for <u><b>{{ ucWords($appointment->purpose) }} </b></u>
    </div>
    <div class="small" style="padding-top:1.5rem;font-size:1rem;">
        Issued and done this on <u><b>{{ date('M d, Y',strtotime($appointment->date_issued)) }} </b></u>.
    </div>

    @if($appointment->document_type == 'brgy_cert')
        <h1 style="font-size:1.4rem;margin-top:4rem;"><b>___________________</b></h1>
        <h1 style="font-size:.9rem;"><b>APPLICANT SIGNATURE</b></h1>

        <div style="text-align:right">
            <h1 style="font-size:1rem;margin-top:1rem;"><b>MARCELINO A. GELLICA JR.</b></h1>
            <h1 style="font-size:.9rem;"><b>PUNONG BARANGAY</b></h1>
        </div>
    @else
        <h1 style="font-size:1rem;margin-top:4rem;"><b>MARCELINO A. GELLICA JR.</b></h1>
        <h1 style="font-size:.9rem;"><b>PUNONG BARANGAY</b></h1>
    @endif

    
</div>


<div class="page-break"></div>


@endsection