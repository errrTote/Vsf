
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
                    padding: 10px 15px 10px 15px;
  		            margin-bottom: 20px;
                    background-color: #fff;
                    border: 1px solid #e3e3e3;
                    border-radius: 4px;
                    ">
                    
			
			<p style="font-size: 24px;"><b>{{trans('text.hi')}} {{$user->first_name }} {{$user->last_name }},</b></p>

			<p>{{trans('text.thanksALot')}}</p>

			<p>{{trans('text.infoVSF')}}</p>

            <p style="margin-top: 20px;">{{trans('text.goLogin')}}</p>
            
            <p style="margin-top: 10px;">{{trans('text.email')}}: {{$user->email}}
            <br>{{trans('text.password')}}: <b>{{$user->password}}</b></p>

			<p style="margin-top: 20px;">{{trans('text.forward')}}</p>
			<p style="margin-top: 50px; font-weight: bold;">{{trans('text.regards')}}<br>{{trans('text.team')}}</p>
			
		</div>

		
	</div>

