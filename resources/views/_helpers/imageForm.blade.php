@if(isset($image))
    @if($columns == 4)
        <div class="col-md-3 col-sm-4 col-xs-6">
    @else
        <div class="col-md-4 col-sm-6 col-xs-12">
    @endif
        <div class="thumbnail">
            <a href="{{route('web.product.show', $image->product->id)}}">
                <img class="imgForm" src="{{ asset('images/product/min/'.$image->name) }}" alt="">
                <div class="caption">
                    <h4 class="text-center">
                        {{mb_strimwidth($image->product->title,0,30,'...')}}
                    </h4>

                    <p>{{mb_strimwidth($image->product->description,0,80,'...')}}</p>

                </div>
                <div class="price">
                    <p class="pull-right">{{$image->product->price}} тг.</p>
                    <p>
                        <span class="glyphicon"></span>
                    </p>
                </div>
            </a>
        </div>
    </div>
@endif