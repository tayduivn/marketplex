@extends('layouts.app-store-front')
@section('title', 'Sales Search')
@section('title-module-name', 'Sales Search')

@section('header-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap Date-Picker Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/vendor/inzaana/js/product/product.js" type="text/javascript"></script>
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(document).ready(function(){
        var date_input_from=$('input[name="from_date"]'); //our date input has the name "date"
        var date_input_to=$('input[name="to_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
          format: 'mm/dd/yyyy',
          container: container,
          todayHighlight: true,
          autoclose: true,
        };
        date_input_from.datepicker(options);
        date_input_to.datepicker(options);
      })
    </script>
@endsection

@section('modals')
    <div id="modal_container">{{--Modal load here--}}</div>
@endsection

@section('content')
@include('includes.message.message') 
<div class="wow fadeIn" data-wow-delay="0.2s" id="app">
  <div class="row">
        <div class="col-10 mx-auto">
          <div class="card">
            <form class="form-horizontal" method="post" action="">
              {{ csrf_field() }}
              <div class="card-header"><h4><strong>Search Sales</strong></h4></div>
              <div class="card-block">
                <div class="form-group">
                  <input type="text" name="bill_id"placeholder="Billing ID"/>
                </div>
                <div class="form-group">
                  <input type="text" name="client_name"placeholder="Client Name"/>
                </div>
                <div class="form-group"> <!-- Date input -->
                  <label class="control-label" for="from_date"><h5><strong>From</strong></h5></label>
                  <input class="form-control" id="from_date" name="from_date" placeholder="MM/DD/YYY" type="text"/>
                </div>
                <div class="form-group"> <!-- Date input -->
                  <label class="control-label" for="to_date"><h5><strong>To</strong></h5></label>
                  <input class="form-control" id="to_date" name="to_date" placeholder="MM/DD/YYY" type="text"/>
                </div>
                <div class="form-group"> <!-- Submit button -->
                  <button class="btn btn-primary" name="submit" type="submit">Search Sales</button>
                </div>
              </div>  
            </form>  
          </div>
        </div>
<!--form end here-->
  </div>
</div>
@endsection
