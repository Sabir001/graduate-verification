@extends('layouts.app')

@section('content')

<div class="row">
        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">

         	<div class="row">
         		<div class="col-md-12">
         			<h2 style="margin-bottom: 40px" class="d-none d-sm-block">Select and search</h2>
		            <div class="jumbotron">

						{!! Form::open(array('id' => 'search_form')) !!}


						<div class="form-group row">
							<div class="col-md-2"><label for="university_id">University </label></div>
							<div class="col-md-10" id="university_list" name="university_id">
								<select class="form-control">
									<option>Select University</option>
								</select>
							</div>
						</div>


					
						<div class="form-group row">
							<div class="col-md-2"><label for="department_id">Department </label></div>
							<div class="col-md-10" id="department_list">
								<select class="form-control" name="department_id">
									<option>Select Department</option>
								</select>
							</div>
						</div>



						<div class="form-group row">
							<div class="col-md-2"><label for="session_no">Session </label></div>
							<div class="col-md-10"><input class="form-control" name="session_no" type="text" id="session_no" pattern="[0-9]{4}-[0-9]{2}">
							</div>
						</div>

						{{ Form::submit('Search', ['class' => 'btn btn-block btn-primary', 'id' => 'btnSubmit']) }}
						{!! Form::open() !!}

						<div class="span9 btn-block">
						    <button class="btn btn-large btn-block btn-primary" hidden="true" id="btnSearchAgain" type="button">Search Again</button>
						</div>


		            </div>
         		</div>

         	</div>


        	<div class="row" hidden="true" id="data">
        		<div class="col-md-12">
        			<h2>Click on the data to see detailed report</h2>
        			<div class="table-responsive">
        				<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    <thead>
	                    <tr>
	                        <th>Student Type</th>
	                        <th class="center">Number of Students</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    <tr>
	                        <td>Total Student</td>
	                        <td class="center" id="num_of_student"></td>
	                    </tr>
	                    <tr>
	                        <td>Requested for Verification</td>
	                        <td id="verification_request"></td>
	                    </tr>
	                    <tr>
	                        <td>Verification on Progress</td>
	                        <td class="center" id="verification_process"></td>
	                    </tr>
	                    <tr>
	                        <td>Verified</td>
	                        <td class="center" id="verified"></td>
	                    </tr>
	                    </tbody>
	                    </table>
        			</div>
        		</div>

        	</div>

			<div class="row">
				<div class="col-md-12">
					<canvas id="doughnut-chart" width="800" height="450"></canvas>
				</div>
			</div>

        </main>

 </div>


@endsection

@section('script')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript" src="{{asset('js/reportJS/datatables.min.js')}}"></script>


    <script>

        $(document).ready(function(){

        	$.ajaxSetup({
				headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
			});

            $( "#search_form" ).submit(function( event ) {
            	$("#btnSubmit").attr("disabled", true);
				$('#btnSubmit').attr('hidden', true);            	

            	$('#btnSearchAgain').attr('hidden', false);

                $.post("{{ URL::route('dynamic_report.student') }}",{
                    university_id: $('#university_id option:selected').val(),
                    department_id: $('#department_id option:selected').val(),
                    session_no: $('#session_no').val()
				},function(data){
					$("#num_of_student").text(data.num_of_student);
                    $("#verification_request").text(data.verification_request);
                    $("#verification_process").text(data.verification_process);
                    $("#verified").text(data.verified);

                    console.log(data);

                /*    $("#num_of_student").html(data.num_of_student); 
                    $("#verification_request").innerhtml = data.verification_request; 
                    $("#verification_process").innerhtml = data.verification_process; 
                    $("#verified").innerhtml = data.verified;*/

                    $('#data').attr('hidden', false);

                    $('.dataTables-example').DataTable({
		            	"order": [],
		                paging: false,
		                responsive: true,
		                dom: '<"html5buttons"B>lTfgitp',
		                buttons: [
		                    { extend: 'copy'},
		                    {extend: 'csv', title: 'Overview Report'},
		                    {extend: 'excel', title: 'Overview Report'},
		                    {extend: 'pdf', title: 'Overview Report'},

		                    {extend: 'print',
		                     customize: function (win){
		                            $(win.document.body).addClass('white-bg');
		                            $(win.document.body).css('font-size', '10px');

		                            $(win.document.body).find('table')
		                                    .addClass('compact')
		                                    .css('font-size', 'inherit');
		                    }
		                    }
		                ]

		            });
                    new Chart(document.getElementById("doughnut-chart"), {
                        type: 'doughnut',
                        data: {
                            labels: ["Total Student", "Requested for Verification", "Verification on Progress", "Verified"],
                            datasets: [
                                {
                                    label: "Number of students",
                                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                    data: [
                                        data.num_of_student,
                                        data.verification_request,
                                        data.verification_process,
                                        data.verified
									]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Overview Report of Students'
                            }
                        }
                    });
                });
                event.preventDefault();
            });


			$.post("{{ URL::route('university.list') }}",{},function(data){
				$('#university_list').html(data);
				departmentList();
			});

			function departmentList(){
				$('#university_id').on('change', function(){
					var university_id = $('#university_id option:selected').val();
					$.post("{{ URL::route('department.list') }}",{university_id:university_id},function(data){
						$('#department_list').html(data);
					});
				});
			}

			$('#btnSearchAgain').on('click', function () {
                location.reload();
            });			

			$('#verification_request').on('click', function () {
                window.location.href = '/report/details?university_id=' + $('#university_id').val() + '&department_id=' + $('#department_id').val() + '&session_no=' + $('#session_no').val() + '&query=' + 'Requested';
            });
            $('#num_of_student').on('click', function () {
                window.location.href = '/report/details?university_id=' + $('#university_id').val() + '&department_id=' + $('#department_id').val() + '&session_no=' + $('#session_no').val() + '&query=' + 'Total';
            });
            $('#verification_process').on('click', function () {
                window.location.href = '/report/details?university_id=' + $('#university_id').val() + '&department_id=' + $('#department_id').val() + '&session_no=' + $('#session_no').val() + '&query=' + 'Paid';
            });
            $('#verified').on('click', function () {
                window.location.href = '/report/details?university_id=' + $('#university_id').val() + '&department_id=' + $('#department_id').val() + '&session_no=' + $('#session_no').val() + '&query=' + 'Verified';
            });


        	
            

        });

    </script>

@endsection
