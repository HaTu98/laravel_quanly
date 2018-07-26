@php
	
	$allTime = 0;
    $timeLeave = 0;
     $month = date('Y-m',strtotime($data->first()->date));

    foreach ($data as $time) {
        $allTime += $time->time_per_day;
        if($time->time_per_day < 8){
            $timeLeave += 8 - $time->time_per_day;
        }

    }

@endphp 
							
 <tr style="text-decoration-color: red">					
 						<td>Time Working in month : {{$month}}</td>
 						<br />
 						<br />
                        <td>Total time working in month:  {{$allTime}} hours
                        <br />
                        Total time leave in month : {{$timeLeave}} hours
                    	</td>  
</tr>
<br />
<table class="table table-striped">
        <thead>
            <tr>
            	<th>STT</th>
              	<th>User ID</th>
              	<th>Name</th>
              	<th>Time Start</th>
             	<th>Time Finish</th>
              	<th>Today</th>
              	<th>Date</th>
            </tr>
        </thead>
        <tbody>
         
        	@php
        		$STT = 0;
        	@endphp
            @foreach($data as $time)
            @php
        		$STT += 1 ;
        	@endphp
                <tr>

                	<td>{{$STT}}</td>
                    <td>{{$time->user_id}}</td>
                    <td>{{Auth::user()->userProfiles->first_name}} {{Auth::user()->userProfiles->last_name}}</td>
                    <td>{{$time->start}}</td>
                    <td>{{$time->finish}}</td>
                    <td>{{$time->time_per_day}}</td>
                    <td>{{$time->date}}</td>
                </tr>
            @endforeach

        </tbody>

    </table>