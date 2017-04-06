
	<div style="font-family: 'Century Gothic';
	            padding: 0px 70px 70px 70px;
                margin-right: auto;
                margin-left: auto;
                background-color: #f5f5f5;
                width: 450px;">

    	<img style="
    			   margin: 15px 0px 15px 130px;
                   width: 185px;
                   height: 125px;" 
            src="{{$message->embed(asset('img/logo.png'))}}">
		<div style="height: 400px;
                    padding: 19px;
  		            margin-bottom: 20px;
                    background-color: #fff;
                    border: 1px solid #e3e3e3;
                    border-radius: 4px;
                    ">
			
			<p style="font-size: 24px;"><b>{{trans('text.hi')}} {{$user->first_name }} {{$user->last_name }},</b></p>

			
			<p style="margin-top: 60px;">{{trans('text.youNewPass')}}: <span style="font-weight: bold;">{{$password }}</span></p>

			
			<p style="margin-top: 45px; font-weight: bold;">{{trans('text.thanks')}}<br>{{trans('text.team')}}</p>
			
		</div>
	</div>




