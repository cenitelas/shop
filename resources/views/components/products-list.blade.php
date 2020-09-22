@if($products->isNotEmpty())
    <div class="d-flex justify-content-center flex-wrap">
        @foreach($products as $product)
            @include('components.product-view')
        @endforeach
    </div>
    <div class="d-flex justify-content-center align-items-center">
        {{ $products->links("pagination::bootstrap-4") }}
    </div>
@else
    <div class="alert alert-secondary">
        Нет товаров
    </div>
@endif
