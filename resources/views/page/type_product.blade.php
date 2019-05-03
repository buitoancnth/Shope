@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm - {{$name_loai_sp->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Home</a> / <span>Loai Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						@foreach ($loai as $l)
							<li><a href="{{route('loai-san-pham', $l->id)}}">{{$l->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4></h4>
						<div class="beta-products-details">
							<p class="pull-left">{{count($sp_theoloai)}} styles found</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
						@foreach($sp_theoloai as $san_pham)							
							<div class="col-sm-4" style="margin-bottom: 10px">
								<div class="single-item">
									@unless( $san_pham->promotion_price==0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endunless
									<div class="single-item-header">
										<a href=""><img src="source/image/product/{{$san_pham->image}}" alt="" height="270"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$san_pham->name}}</p>
										<p class="single-item-price">
											@if($san_pham->promotion_price == 0)
												<span class="flash-sale">{{ number_format($san_pham->unit_price) }}</span>
											@else
												<span class="flash-del">{{ number_format($san_pham->unit_price) }}</span>
												<span class="flash-sale">{{ number_format($san_pham->promotion_price) }}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang', $san_pham->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('product-detail', $san_pham->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sản Phẩm Khác</h4>
						<div class="beta-products-details">
							<p class="pull-left">{{count($sp_khac)}} styles found</p>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($sp_khac as $sp_k)
								<div class="col-sm-4">
									<div class="single-item">
										@if($sp_k->promotion_price != 0)
											<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="product.html"><img src="source/image/product/{{$sp_k->image}}" alt="" height="250"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$sp_k->name}}</p>
											<p class="single-item-price">
												@if($sp_k->promotion_price == 0)
													<span class="flash-sale">{{ number_format($sp_k->unit_price) }}</span>
												@else
													<span class="flash-del">{{ number_format($sp_k->unit_price) }}</span>
													<span class="flash-sale">{{ number_format($sp_k->promotion_price) }}</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themgiohang', $sp_k->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('product-detail', $sp_k->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						<div class="row">{{$sp_khac->links()}}</div>
						<div class="space40">&nbsp;</div>
						
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->
		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection