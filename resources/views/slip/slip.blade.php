
<html>

<head>
	<style>
		body {
			line-height: .8em;
			margin: 0;
			padding: 0;
			font-size: 10px;
			font-family: Arial, Helvetica, sans-serif;
		}
		.smallfont {
			font-size: 10px;
		}

		.midfont {
			font-size: 12px;
		}

		.bigfont {
			font-size: 14px;
		}

		td {
			line-height: 1em;
		}
		@media print
		{    
			.no-print, .no-print *
			{
				display: none !important;
			}
			.slip-wrapper{
				margin: auto;
			}

		}
		@page {
			size: 4in;
			margin: 15px;
		}
	</style>
	<script>
		function print_it() {
			window.print();
		}
		function back() {
			// window.location.href = `{{ url('/') }}/sells/create`
			window.history.back()
		}
	</script>
</head>

<body>
	<div class="no-print" style="text-align: center;padding: 15px;">
		<button onclick="back()">← Back</button>
		<button onclick="print_it()">🖨 Print</button>
	</div>
	<table width="576" border="0" cellpadding="0" cellpadding="0" align="center" id="slip-wrapper">
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellpadding="0" align="center">
					<tr>
						<td width="100px">
							<img src='{{ url('/') }}/images/logo-white.png' width="65" height="65" />
						</td>
						<td align="left" width="300px">
							<font class="bigfont"><b>লাবন্য ডায়গনষ্টিক সেন্টার</b></font>
							<br />
							<font class="smallfont"><b>Labanna Diagonostic Center</b></font>
							<br />
							<font class="smallfont"><b>ভান্ডারিয়া হাসপাতাল সংলগ্ন , ভান্ডারিয়া , পিরোজপুর</b></font>
							<br />
							<font class="smallfont"><b>মোবাইলঃ ০১৭১২১৮৮৩৩৯, ০১৭১০৯৩৬৪৩৬</b></font>
							<br />
						</td>
						<td width="250px" align="right" valign="top">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<table width="100%" align="center" border="0">
								<tr>
									<td width="30%" valign="top">
									<font class="smallfont"><b>Name: {{$slip->customer_name}}</b></font>
									</td>
									<td width="20%" valign="top">
									<font class="smallfont"><b>Age:</b> {{$slip->customer_age}}</font>
									</td>
									
									<td width="30%" valign="top" align="left">
										<b>
											<font class="midfont">Sex: {{$slip->customer_gender}}</font><b>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" valign="top">
							<table width="100%" align="left" border="0" cellpadding="0">
								<tr>
									<td width="150px" valign="top">
										<table width="95%" border="0" cellspacing="0" cellpadding="0" align="0">
											<tr>
												<td width='65px'><u><b>
															<font class="smallfont">Test Name</font>
														</b></u>
												</td>
												{{-- <td width='50px'><u><b>
															<font class="smallfont">Unit Price</font>
														</b></u></td>
												<td width='35px'><u><b>
															<font class="smallfont">Quantity</font>
														</b></u></td> --}}
												<td width='40px' align="right"><u><b>
															{{-- <font class="smallfont">Net Price</font> --}}
															<font class="smallfont">Price</font>
														</b></u></td>
											</tr>

											@foreach ($slip->orders as $order)
											<tr style="border-bottom: 1px dashed #DDD;">
												
												<td>
													<font class="smallfont">{{$order->product->name}}</font>
												</td>
												{{-- <td>
													<font class="smallfont">{{$order->product->price}}</font>
												</td>
												<td>
													<font class="smallfont">{{$order->quantity}}</font>
												</td> --}}
												<td align="right">
												<font class="smallfont">{{$order->sell_price}}</font>
												</td>
											</tr>
											<tr height='3px'></tr>
											@endforeach
											
										</table>
									</td>
									<td width="180px" style="border-left: 1px dashed #000;padding-left:20px">
										<table cellspacing="0" cellpadding="0">
											<td>
												@if ($slip->doctor)
												<font class="bigfont"><b>Refered to:</b> {{$slip->doctor->name}}</font> <br><br>
												@endif


												<font class="smallfont"><b>Total Amount:</b> 
													{{$slip->orders->sum('sell_price')}}
												</font> <br>
												<font class="smallfont"><b>Discount:</b> {{$slip->discount}}</font> <br>
												<font class="smallfont"><b>Bill:</b> {{$slip->orders->sum('sell_price') - $slip->discount}}</font> <br>
												<font class="smallfont"><b>Paid:</b> {{$slip->paid}}</font> <br>
												<font class="smallfont"><b>Return:</b> {{$slip->paid - ($slip->orders->sum('sell_price') - $slip->discount)}}</font> <br>
											</td>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
	</table>
</body>

</html>