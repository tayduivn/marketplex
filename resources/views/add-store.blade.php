@extends('layouts.app-dashboard-admin')
@section('title', 'Stores')
@section('title-module-name', 'Stores')

@section('header-style')
  <link rel="stylesheet" href="/jquery-validation/css/screen.css">
  <style type="text/css">

  #edit-profile-form label.error {
    margin-left: 10px;
    width: auto;
    display: inline;
  }

  .hide{
    display: none;
  }

  </style>
@endsection

@section('footer-scripts')
<!-- 
<script src="/jquery-validation/lib/jquery.js"></script>
<script src="/jquery-validation/dist/jquery.validate.js"></script>
<script src="/form-validation/edit-store-validation.js"></script>
<script src="/form-validation/edit-profile-validation.js"></script>
<script>
    $().ready(onReadyEditStoreValidation);
    $('#phone_number').keypress(validateNumber);
    $('#postcode').keypress(validateNumber);

    $( "input[name='store_name']" ).focusout(onFocusOutRequestForStoreSuggestion);

</script>
 -->
@endsection

@section('content')
<div class="box box-info">    
    <div class="box-body">
      <div class="row padTB"> 
          <div class="col-lg-6 col-lg-offset-3">
            <div class="box box-noborder">

              <div class="box-header with-border">
                <h3 class="box-title">Add your Store</h3>
              </div>

              <!-- form start -->
              <form role="form" id="edit-store-form" action="{{ isset($store) ? route('user::stores.update', [$store]) : route('user::stores.create') }}" method="POST">

                {!! csrf_field() !!}

                <div class="box-body">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="Store-name">Store</label>
                    <input type="text" class="form-control" value="{{ isset($store) ? $store->name : '' }}" id="store_name" name="store_name" placeholder="Add your Store name here...">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif            					
                    
                    <!--Store name suggestion. Just change the visibility to show/hide it : visible/hide-->
                    <!-- <div class="input-group input-group-lg">
                    <p>
                    <label>
                      <span class="glyphicon glyphicon-random"></span>
                      <label id="suggestions"></label>
                    </label>
                    </p>
                    </div> 
 -->
                  </div>

                    <div>
                        <label for="contact-number"> Contact Number</label>

                        <div class="row col-sm-12 col-md-12 col-lg-12">
                            <!-- <div class="row col-sm-1 col-md-1 col-lg-1" style="text-align: right">code</div> -->
                            <div class="form-group col-sm-2 col-md-2 col-lg-2">
                                <div>
                                    <select name="code" text="code" class="form-control">
                                      @foreach($area_codes as $key => $area_code)
                                        <option value="{{ $area_code }}" {{ $phone_number[0] == $key ? 'selected' : '' }}>{{ $area_code }}</option>
                                      @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" value="{{ $phone_number[1] or '' }}" id="phone_number" name="phone_number" placeholder="Phone number...">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('phone_number') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1"><button type="button" class=" hide btn btn-primary">verify</button></div>
                        </div>
                    </div>

				          <div class="form-group">
                    <label for="address">Address</label>
					           <input type="text" class="form-control" value="{{ $address['HOUSE'] or old('address_flat_house_floor_building') }}" id="address_flat_house_floor_building" name="address_flat_house_floor_building" placeholder="Flat / house no / floor / Building">
                    <br/>
                    <input type="text" class="form-control" value="{{ $address['STREET'] or old('address_colony_street_locality') }}" id="address_colony_street_locality" name="address_colony_street_locality" placeholder="Colony / Street / Locality">
                    <br/>
                    <input type="text" class="form-control" value="{{ $address['LANDMARK'] or old('address_landmark') }}" id="address_landmark" name="address_landmark" placeholder="Landmark (optional)">
                    <br/>
                    <input type="text" class="form-control" value="{{ $address['TOWN'] or old('address_town_city') }}" id="address_town_city" name="address_town_city" placeholder="Town / City">
                    <br/>                  
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Store Description</label>
                    <textarea placeholder="Add Store description here..." class="form-control" rows="5" id="description" name="description">{{ isset($store) ? $store->description : '' }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                  <button type="{{ $submitable ? 'submit' : 'button' }}"
                          class="btn btn-info btn-flat{{ $submitable ? '' : ' disabled' }}"
                          data-toggle="tooltip" data-placement="top" title="{{ $store_count_warning }}">
                          {{ isset($store) ? 'Update' : 'Add' }} Store</button>
                </div>
              </form>
              <!--end of form-->

            </div>
          </div>
    </div>
</div>
    
    <!--recently added product-->
    <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">My Store List</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="parent" class="table table-hover">
                    <tr>
                      <th class="text-center">Store Name</th>

                      <th class="text-center">Address</th>
                      <th class="text-center">Action</th>
                    </tr>
                    @if(isset($stores))
                      @foreach($stores as $store)
                      <tr>
                        <td class="text-center" id="child">
                          @include('includes.store-redirect-link', 
                              $single_store ?
                                [
                                  'route' => 'store-front',
                                  'single' => $single_store,
                                  'title' => $store->name
                                ] : [
                                      'url' => $store->getTidyUrl(),
                                      'title' => $store->name 
                                    ])
                        </td>

                        <td class="text-center" id="child">{{ MarketPlex\Helpers\ContactProfileManager::tidyAddress($store->address) }}</td>

                        <td class="text-center" id="child">
                          <form id="store-edit-form">                            
                            <input formmethod="GET" formaction="{{ route('user::stores.edit', [$store]) }}" formnovalidate="formnovalidate"
                                    id="store-edit-btn" class="btn btn-info btn-flat btn-xs" type="submit" value="Edit"></input>
                          </form>
                          @if ($store->isStoreDeleteAllowed())
                          <form id="store-delete-form" class="form-horizontal">
                            {!! csrf_field() !!}
                            <input formmethod="POST" formaction="{{ route('user::stores.delete', [$store]) }}" formnovalidate="formnovalidate" 
                                    id="store-delete-btn" class="btn btn-info btn-flat btn-xs" type="submit" value="Delete"></input>
                          </form>
                          @endif
                        </td>

                      </tr>
                      @endforeach
                    @endif
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
    <!--end of recently added product-->

@endsection