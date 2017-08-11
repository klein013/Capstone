<!DOCTYPE html>
<html>
<head>
	<title>Clearance | Requests</title>
	@include('admin.layout.head');
	<link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav');
<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../{{$return['image']}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="email">Official ID: <strong id="sessionpos">{{$return['position']}}</strong></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/')}}"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($return['position']==0)
                @include('admin.aside_admin');
            @elseif($return['position']==1)
                @include('admin.aside_pb');
            @elseif($return['position']==2)
                @include('admin.aside_pb');
            @elseif($return['position']==3)
                @include('admin.aside_admin');
            @elseif($return['position']==4)
                @include('admin.aside_sec');
            @elseif($return['position']==5)
                @include('admin.aside_desk');
            @elseif($return['position']==6)
                @include('admin.aside_bpso');
            @elseif($return['position']==7)
                @include('admin.aside_cashier');
            @endif

        </aside>

	
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">border_color</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> REQUEST</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Request"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable" id="requestTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Type</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        <th>ha</th>
                                    </tr>
                                </thead>
                               <tbody>
                               	@foreach($requests as $request)
                               		<tr>
                               			<td>{{ $request->ID }}</td>
                               			<td>{{ $request->Name }}</td>
                               			<td>{{ $request->Type }}</td>
                               			<td>{{ $request->Purpose }}</td>
                               			<td>{{ $request->Status }}</td>
                               			@if($request->Status == 'Pending' || $request->Status == 'On-going')
                                            @if($request->cid==12)
                                                <td><button type = 'button' class = 'print btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Print Request'><i class='material-icons'>print</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td>
                                            @else
                                                <td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td>
                                            @endif
                                        @else
                                            <td><button type = 'button' class = 'print btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Print Request'><i class='material-icons'>print</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td>
                                        @endif
                                        <td>{{ $request->cid}}</td>
                               		</tr>
                               	@endforeach
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# With Material Design Colors -->
        </div>
    </section>

<div class="modal fade" tabindex="-1" id="noDerogatory" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Certificate of No Derogatory Record</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="noDerogatory1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="noDerogatoryProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Residency" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Certificate of Residency</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="residency1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="residencyProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Indigency" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h4>Certificate of Indigency</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="indigency1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="indigencyProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Transportation" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Transportation Barangay Clearance</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Toda Name</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="transpo1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Maker/ Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="20" class="form-control" id="transpo2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Motor Number</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="20" class="form-control" id="transpo3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Chassis Number</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="20" class="form-control" id="transpo4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Plate Number</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="20" class="form-control" id="transpo5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Body Number</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="number" min="1" max="999" class="form-control" id="transpo6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Color Code</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="20" class="form-control" id="transpo7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="transpoProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Electric" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Electric Connection Barangay Clearance</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Provider</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="Electric1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="ElectricProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Water" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Water Connection Barangay Clearance</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="Water1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Provider</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="Water2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="WaterProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="BusinessA" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Business Barangay Clearance A</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Business Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="BusinessA1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="BusinessAProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="BusinessB" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Business Barangay Clearance B</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Business Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="BusinessC1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="BusinessCProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="BusinessC" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Business Barangay Clearance C</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Business Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="BusinessC1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="BusinessCProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="BusinessD" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Business Barangay Clearance D</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Business Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="BusinessD1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="BusinessDProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="BusinessE" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Business Barangay Clearance E</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Business Type</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="BusinessE1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="BusinessEProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="Construction" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Construction Barangay Clearance</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="Construction1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="ConstructionProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="Excavation" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Excavation Permit Barangay Clearance</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-1">
                            <h5>Additional Details</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Purpose</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" maxlength="50" class="form-control" id="Excavation1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="ExcavationProcess">Process Request</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <div class="row clearfix">
                            <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">border_color</i>
                            </div>
                            <div class="content">
                            <div class="text"><h3> ADD REQUEST</h3></div>
                            </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form>
                            	{{ csrf_field() }}
                                <label for="resident_id">Resident ID</label>
                                <div class="row clearfix">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Type Resident ID" id="rid" required>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                	<label>OR</label>
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                	<button type="button" class="btn btn-lg bg-blue waves-effect" id="pick">Pick a Resident</button>	
                                </div>
                                </div>
                                <div>
                                <label for="clearance_id">Clearance Type</label>
                                <div class="form-group">
                                	<span>
                                        <select class="form-control show-tick" id="ctype">
                                    	<option value="" disabled>Pick a Clearance Type</option>
                                    	@foreach($clearances as $clearance)
                                    		<option value="{{ $clearance->Clearance_ID }}">{{ $clearance->Clearance_Type }}</option>
                                    	@endforeach
                                    </select>
                                    </span>
                                </div>
                        <div class="row clearfix">    
                            <div class="col-md-4 col-md-offset-8">
                            <button type="button" class="btn bg-teal btn-lg waves-effect" id="add">ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                        <br>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row clearfix">
                    <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">border_color</i></div>
                            <div class="content">
                            	<div class="text"><h3> ADD REQUEST</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<label>Registered Residents</label>
					</div>
				</div>
				<br>
				<div>
					<div class="col-md-12">
						<table class="table dataTable" id="resTable">
							<thead>
								<tr class="bg-blue-grey">
									<th>ID</th>
									<th>Image</th>
									<th>Name</th>
									<th>Birthdate</th>
									<th>Gender</th>
									<th>Address</th>	
								</tr>
							</thead>
							<tbody>
								@foreach($residents as $resident)
									<tr>
										<td>{{ $resident->Resident_ID }}</td>
										<td><img src="{{ $resident->Resident_Image}}" width="40px" height="40px"></td>
										<td>{{ $resident->Resident_Name }}</td>
										<td>{{ $resident->Resident_Bdate }}</td>
										@if($resident->Resident_Sex=='M')
											<td>Male</td>
										@else
											<td>Female</td>
										@endif
										<td>{{ $resident->Resident_Add }}</td>
									</tr>
								@endforeach
							</tbody>					
						</table>
					</div>
				</div>
				<br>
				<div class="row clearfix">
					<div class="col-md-4">
						<label>Picked Resident ID:</label>
					</div>
					<div class="col-md-4">
						<label id="resid"></label>
					</div>
					<div class="col-md-4">
						<button type="button" class="btn bg-teal btn-lg waves-effect" id='resok'>OK</button>
                        <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('admin.layout.scripts');
<script>
	$(document).ready(function(){
        var finalreqid;
		var CSRF_TOKEN =$('meta[name="csrf-token"]').attr('content');
		$('#resTable').dataTable({
			bSort : false
		});

		$('#pick').on('click', function(){
			$('#defaultModal2').modal('toggle');
		});

		

		$('#resTable tbody').on( 'click', 'tr', function () {
        	$('#resid').text(table.row($(this)).data()[0]);
    	});

    	$('#resok').on('click', function(){ 
    		$('#rid').val($('#resid').text());
    		$('#defaultModal2').modal('toggle');
    	});


    	$('#requestTable').dataTable({
    		bSort : false,
            "columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            }
            ]
    	});

        var table = $('#requestTable').DataTable();

    	$('#add').on('click', function(){
    		$.ajax({
    			url : '/clearance',
    			method : 'POST',
    			data : {
    				_token : CSRF_TOKEN,
    				id : $('#rid').val(),
    				ctype : $('#ctype').val()
    			},
    			dataType : 'json',
    			success : function(response){
                    $('#defaultModal').modal('toggle');
                    if(response[0]!=null){
                        if(response=="too many"){
                            swal({
                                title : "Too Many request",
                                type : "error",
                                timer : 1000,
                                showConfirmButton : false
                            });
                        }
                        else{
                            if(response[0].Purpose == null){
                                var pur = "";
                            }
                            else{
                                var pur = response[0].Purpose;
                            }
                            finalreqid = response[0].ID;
                            if($('#ctype').val()=='1'){

                                $('#noDerogatory').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='2'){
                                $('#Residency').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'submit' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='3'){
                                $('#Indigency').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='4'){
                                $('#Transportation').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='5'){
                                $('#Electric').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='6'){
                                $('#Water').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }  
                            else if($('#ctype').val()=='7'){
                                $('#BusinessA').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();    
                            }
                            else if($('#ctype').val()=='8'){
                                $('#BusinessB').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='9'){
                                $('#BusinessC').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='10'){
                                $('#BusinessD').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='11'){
                                $('#BusinessE').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='12'){
                                $('#BusinessLiquor').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'submit' class = 'print btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Print Request'><i class='material-icons'>print</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='13'){
                                $('#Construction').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }
                            else if($('#ctype').val()=='14'){
                                $('#Excavation').modal('toggle');
                                var newRow = "<tr><td>"+response[0].ID+"</td><td>"+response[0].Name+"</td><td>"+response[0].Type+"</td><td>"+pur+"</td><td>"+response[0].Status+"</td><td><button type = 'button' class = 'process btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Process Request'><i class='material-icons'>cached</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td><td>"+response[0].cid+"</td></tr>";
                                table.row.add($(newRow)).draw();
                            }       
                            swal({
                                title : "Record Added",
                                type : "success",
                                timer : 1000,
                                showConfirmButton : false
                            });

                        }
    		      	}
                    else{
                        swal({
                            title : "Request Exists",
                            type : "error",
                            timer : 1000,
                            showConfirmButton : false
                        });
                    }
                    
                }
    		});
    	});

        $('#requestTable tbody').on('click', 'button.print', function(){
            var id = table.row($(this).parents('tr')).data()[0];
            var name = table.row($(this).parents('tr')).data()[1];
            var cid = table.row($(this).parents('tr')).data()[6];
            if(cid=='1'){
                $.ajax({
                    url : 'clearance_noDerogatory/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='2'){
                $.ajax({
                    url : 'clearance_residency/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=="3"){
                $.ajax({
                    url : 'clearance_indigency/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                    },
                    success : function(response){

                    }
                });
            }
            else if(cid=="4"){
                $.ajax({
                    url : 'clearance_transpo/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                    },
                    success : function(response){

                    }
                });
            }
            else if(cid=='5'){
                $.ajax({
                    url : 'clearance_electric/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='6'){
                $.ajax({
                    url : 'clearance_transpo/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='7'){
                $.ajax({
                    url : 'clearance_businessa/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='8'){
                $.ajax({
                    url : 'clearance_businessb/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='9'){
                $.ajax({
                    url : 'clearance_businessc/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='10'){
                $.ajax({
                    url : 'clearance_businessd/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='11'){
                $.ajax({
                    url : 'clearance_businesse/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='12'){
                $.ajax({
                    url : 'clearance_businessliquor',
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='13'){
                $.ajax({
                    url : 'clearance_construction/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
            else if(cid=='14'){
                $.ajax({
                    url : 'clearance_excavation/'+id,
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){

                    }
                });            
            }
        })

        $('#requestTable tbody').on('click', 'button.process', function(){
            finalreqid = table.row($(this).parents('tr')).data()[0];
            var id = table.row($(this).parents('tr')).data()[0];
            var name = table.row($(this).parents('tr')).data()[1];
            var cid = table.row($(this).parents('tr')).data()[6];
//            alert('pakshit');
            if(cid=='1'){
                $('#noDerogatory').modal('toggle');
            }
            else if(cid=='2'){
                $('#Residency').modal('toggle');
            }
            else if(cid=='3'){
                $('#Indigency').modal('toggle');
            }
            else if(cid=='4'){
                $('#Transportation').modal('toggle');
            }
            else if(cid=='5'){
                $('#Electric').modal('toggle');
            }
            else if(cid=='6'){
                $('#Water').modal('toggle');
            }
            else if(cid=='7'){
                $('#BusinessA').modal('toggle');
            }
            else if(cid=='8'){
                $('#BusinessB').modal('toggle');
            }
            else if(cid=='9'){
                $('#BusinessC').modal('toggle');
            }
            else if(cid=='10'){
                $('#BusinessD').modal('toggle');
            }
            else if(cid=='11'){
                $('#BusinessE').modal('toggle');
            }
            else if(cid=='12'){
                $('#BusinessLiquor').modal('toggle');
            }
            else if(cid=='13'){
                $('#Construction').modal('toggle');
            }
            else if(cid=='14'){
                $('#Excavation').modal('toggle');
            } 
        });

        $('#requestTable tbody').on('click', 'button.delete', function(){
            var row = table.row($(this).parents('tr')).index();
            var id = table.row($(this).parents('tr')).data()[0];
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this request!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },  
                function(isConfirm) {
                    if (isConfirm){
                        $.ajax({
                            url : 'clearance',
                            method : 'POST',
                            data : {
                                _token : CSRF_TOKEN,
                                _method : 'DELETE',
                                id : id 
                            },
                            success : function(){
                                table.row(row).remove().draw();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Request has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                            }
                        });
                    } 
                    else {
                        swal({
                            title : "Cancelled", 
                            text : "Request is not deleted",
                            type :  "error",
                            showConfirmButton : false,
                            timer : 1000
                        });
                    }
                });     
        });

        $('#noDerogatoryProcess').on('click', function(){
            $.ajax({
                url : '/clearance_noDerogatory',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#noDerogatory1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#indigencyProcess').on('click', function(){
            $.ajax({
                url : '/clearance_indigency',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#indigency1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#transpoProcess').on('click', function(){
            $.ajax({
                url : '/clearance_transpo',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    toda : $('#transpo1').val(),
                    maker : $('#transpo2').val(),
                    motor : $('#transpo3').val(),
                    chassis : $('#transpo4').val(),
                    plate : $('#transpo5').val(),
                    body : $('#transpo6').val(),
                    color : $('#transpo7').val()
                },
                success : function(response){
                    window.location.reload();
                }
            })
        });

        $('#residencyProcess').on('click', function(){
            $.ajax({
                url : '/clearance_residency',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#residency1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#BusinessAProcess').on('click', function(){
            $.ajax({
                url : '/clearance_businessa',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#BusinessA1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#BusinessBProcess').on('click', function(){
            $.ajax({
                url : '/clearance_businessb',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#BusinessB1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#BusinessCProcess').on('click', function(){
            $.ajax({
                url : '/clearance_businessc',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#BusinessC1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#BusinessDProcess').on('click', function(){
            $.ajax({
                url : '/clearance_businessd',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#BusinessD1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#BusinessEProcess').on('click', function(){
            $.ajax({
                url : '/clearance_businesse',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#BusinessE1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#WaterProcess').on('click', function(){
            $.ajax({
                url : '/clearance_water',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#Water1').val(),
                    provider : $('#Water2').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#ElectricProcess').on('click', function(){
            $.ajax({
                url : '/clearance_electric',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#Electric1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#ConstructionProcess').on('click', function(){
            $.ajax({
                url : '/clearance_construction',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#Construction1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

        $('#ExcavationProcess').on('click', function(){
            $.ajax({
                url : '/clearance_excavation',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id : finalreqid,
                    purpose : $('#Water1').val()
                },
                success : function(response){
                    window.location.reload();
                }
            });
        });

	});
</script>
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
   	<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>