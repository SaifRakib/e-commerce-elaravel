@extends('admin_layout')

@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
					</div>

					<p class="alert alert-success">
						<?php
						$message = Session::get('message');
					
						
						if ($message)
						{
							echo $message;
							Session::put('message',null);
						
						}
							
							 
						?>	 
					
					</p>

					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                  <th>Slider Id</th>
		
								  <th>Slider Image</th>
                                  
                                  <th>Actions</th>
                               
							  </tr>
						  </thead> 
						@foreach($all_slider_info as $v_slider)
						  <tbody>
							<tr>
								<td>{{ $v_slider->slider_id }}</td>
								
                                <td class="center"><img src="{{ URL::to($v_slider->slider_image)}}" style="width: 400px;" alt=""></td>
                    
                               
	
								<td class="center">
									
									<!-- <a class="btn btn-info" href="{{URL::to('/edit-slider/'.$v_slider->slider_id)}}">
										<i class="halflings-icon white edit"></i>   -->
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-slider/'.$v_slider->slider_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						  </tbody>
					@endforeach()
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->




@endsection