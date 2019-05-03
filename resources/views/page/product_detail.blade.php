@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Product - {{$san_pham->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Product Detail</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					
					<div class="col-sm-4">
						<div class="single-item">
							@if( $san_pham->promotion_price!=0)
								<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
							@endunless
							<div class="single-item-header">
								<a href=""><img src="source/image/product/{{$san_pham->image}}" alt="" height="250"></a>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
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

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p>{{$san_pham->description}}</p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Options:</p>
						<div class="single-item-options">
							{{-- <select class="wc-select" name="size">
								<option>Size</option>
								<option value="XS">XS</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<select class="wc-select" name="color">
								<option>Color</option>
								<option value="Red">Red</option>
								<option value="Green">Green</option>
								<option value="Yellow">Yellow</option>
								<option value="Black">Black</option>
								<option value="White">White</option>
							</select> --}}
							<select class="wc-select" name="color">
								<option>Số Lượng</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Mô Tả</a></li>
						<li><a href="#tab-reviews">Reviews (0)</a></li>
					</ul>

					<div class="panel" id="tab-description">
						<p>{{$san_pham->description}}</p>
					</div>
					<div class="panel" id="tab-reviews">
						<p>No Reviews</p>
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Related Products</h4>

					<div class="row">
						@foreach($sp_related as $sptt)
							<div class="col-sm-4">
								<div class="single-item">
									@if($sptt->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="#"><img src="source/image/product/{{$sptt->image}}" alt="" height="270px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sptt->name}}</p>
										<p class="single-item-price">
											@if($sptt->promotion_price == 0)
												<span class="flash-sal">{{ number_format($sptt->unit_price) }}</span>
											@else
												<span class="flash-del">{{ number_format($sptt->unit_price) }}</span>
												<span class="flash-sale">{{ number_format($sptt->promotion_price) }}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="#"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('product-detail', $sptt->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div>{{$sp_related->links()}}</div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Best Sellers</h3>
					<div class="widget-body">
						@foreach($best_sellers as $best_sell)
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/image/product/{{$best_sell->image}}" alt="" height="55" width="58"></a>
									<div class="media-body">
										{{$best_sell->name}}
										<span class="beta-sales-price">{{$best_sell->price}}</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">New Products</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@foreach($new_products as $new_proruct)
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/image/product/{{$new_proruct->image}}" alt=""></a>
									<div class="media-body">
										{{$new_proruct->name}}
										<span class="beta-sales-price">{{$new_proruct->price}}</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> 
@endsection