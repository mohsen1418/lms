<script>
    function itpro(Number) 
  {
       Number+= '';
        Number= Number.replace(',', ''); Number= Number.replace(',', ''); Number= Number.replace(',', '');
        Number= Number.replace(',', ''); Number= Number.replace(',', ''); Number= Number.replace(',', '');
        x = Number.split('.');
        y = x[0];
        z= x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
         while (rgx.test(y))
          y= y.replace(rgx, '$1' + ',' + '$2');
          return y+ z;
  }
</script>
<script src="{{ asset('assets/vendors/bundle.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/examples/select2.js') }}"></script>
<script src="{{ asset('assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/examples/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/examples/clockpicker.js') }}"></script>
<script src="{{ asset('assets/vendors/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/charts/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/examples/charts.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
