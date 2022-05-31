<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SUAREZ | PRINT</title>
    <link rel="icon" href="{{ asset('img/suarez_logo.png') }}">
</head>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style type="text/css">
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
    /* ... the rest of the rules ... */
    }
    body {
      background: rgb(204,204,204); 
    }
    .page-break{
      page-break-before:always;
    }

    .table-pdf thead th{
      border:none;
    }

    .font-bold {
        font-weight: 700;
    }
    
    .text-center th{
      text-align: center;
    }

    .text-secondary-2 {
      color: #484848 !important;
    }

    .text-uppercase {
      text-transform: uppercase;
    }

    div.sig-line {
      -webkit-text-decoration-line: overline; /* Safari */
      text-decoration-line: overline; 
    }

    .no-border{
      border:none !important;
    }

    .table-no-border td{
      border:none;
    }
    page {
      background: white;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
      width: 21cm;
      height: 29.7cm; 
    }
    page[size="A4"][layout="landscape"] {
      width: 29.7cm;
      height: 21cm;  
    }
    page[size="A3"] {
      width: 29.7cm;
      height: 42cm;
    }
    page[size="A3"][layout="landscape"] {
      width: 42cm;
      height: 29.7cm;  
    }
    page[size="A5"] {
      width: 14.8cm;
      height: 21cm;
    }
    page[size="A5"][layout="landscape"] {
      width: 21cm;
      height: 14.8cm;  
    }
    @media print {
      body, page {
        margin: 0;
        box-shadow: 0;
      }

      table {
        font-size: 11px;
      }
    }

    a{
        color: #000 !important;
    }

    .table thead th.dark {
      border-bottom: 2px solid #040404 !important;
      border-top: 2px solid #040404 !important;
    }

    .border-bottom {
      border-bottom: 1px solid #e9ecef;
    }

    .underline{
      text-decoration: underline;
    }

    .no-border {
      border-top: none !important;
    }

    .p-5 {
      padding: 5px !important;
    }

    .p-10 {
      padding: 10px !important;
    }

    .p-1 {
      padding: 1em;
    }

    .p-2 {
      padding: 2em;
    }

    .mb-0 {
      margin-bottom: 0;
    }

    .mb-2 {
      margin-bottom: 0.5rem !important;
    }

    .mb-4 {
      margin-bottom: 1rem !important;
    }

    .mb-5 {
      margin-bottom: 2rem !important;
    }

    .mb-45 {
      margin-bottom: 1.5rem !important;
    }

    .mt-2 {
      margin-top: 0.5rem !important;
    }

    .mt-4 {
      margin-top: 1rem !important;
    }

    .mt-45 {
      margin-top: 1.5rem !important;
    }

    .mt-5 {
      margin-top: 2rem !important;
    }

    .mt-6 {
      margin-top: 3rem !important;
    }

    .ml-5 {
      margin-left: 2rem !important;
    }

    .ml-6 {
      margin-left: 3.5rem !important;
    }

    .ml-15 {
      margin-left: 15rem !important;
    }

    .ml-17 {
      margin-left: 17rem !important;
    }

    .ml-18 {
      margin-left: 18rem !important;
    }

    .pl-5{
      padding-left: 0.5em !important;
    }

    .pl-1{
      padding-left: 1em !important;
    }

    .pl-0{
      padding-left: 0 !important;
    }

    .p-lb-05{
      padding-left: .5rem !important;
      padding-bottom: 0 !important;
    }

    .pt-05{
      padding-top: .5rem !important;
    }

    .p-i-s-10 {
      padding-inline-start: 10px !important;
    }

    .dot {
      height: 10px;
      width: 10px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
    }

    ul.no-style {
      list-style-type: none !important;
    }

    .yellow-dot {
      height: 10px;
      width: 10px;
      background-color: #f9cb45;
      border-radius: 50%;
      display: inline-block;
    }

    .block-50{
        width: 50%;
        display: block;
        float: left;
    }

    .table-xxs th, .table-xxs td{
      font-size: 12px;
      border-collapse: separate;
      border-spacing:0 20px;
    }

    .table-xxs td, .table-xxs th {
      padding: .25rem;
      /* vertical-align: top; */
      border-top: 1px solid #e9ecef;
    }

    .table-form td {
      font-size: 80% !important;
      font-weight: 400 !important;
    }

    .table-form th {
      padding: .05rem !important;
      text-align: center;
      background-color: rgb(204 204 204) !important;
    }

    .table-sm td, .table-sm th{
        padding: 0;
    }

    .table-sm td p{
        margin-bottom: 0;
    }

    .v-align {
      vertical-align: middle !important;
      text-align: center !important;
    }
</style>
<body onload="window.print()">
    <div class="container">
      <div class="card">
        <div class="card-body">
            @yield('content')
        </div>
      </div>
    </div>

    <script type="text/javascript" src="{{ url('files/bower_components/jquery/js/jquery.min.js') }}"></script>
</body>

<script type="text/javascript">

   $(document).ready(function(){
      var el = $('.romanize');

      el.each(function(i, obj) {
        var romanize = $(this).text();
        console.log(romanize);
        $(this).html(roman(romanize));  
      }); 
  });

  function roman(num) {
    var lookup = {M:1000,CM:900,D:500,CD:400,C:100,XC:90,L:50,XL:40,X:10,IX:9,V:5,IV:4,I:1},roman = '',i;
    for ( i in lookup ) {
      while ( num >= lookup[i] ) {
        roman += i;
        num -= lookup[i];
      }
    }
    return roman;
  }
</script>

</html>