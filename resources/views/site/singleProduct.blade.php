@extends('layouts.app')
@section('body')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('assets/img/bg-2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span><a
                                href="{{ route('products') }}">Products <i class="fa fa-chevron-right"></i></a></span>
                        <span>Products Single <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h2 class="mb-0 bread">{{ $product->name }}</h2>
                </div>
            </div>
        </div>
    </section>
    @if ($allergicIngredients->count())
        <!-- Hidden button to trigger modal -->
        <button type="button" id="triggerAllergyModal" class="d-none" data-toggle="modal"
            data-target="#allergyWarningModal"></button>

        <!-- Allergy Warning Modal -->
        <div class="modal fade" id="allergyWarningModal" tabindex="-1" role="dialog" aria-labelledby="allergyWarningLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-danger">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white" id="allergyWarningLabel">
                            Allergy Warning
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-danger">
                        <p><strong>This product contains ingredients you may be allergic to:</strong></p>
                        <ul>
                            {{-- Loop through the allergic ingredients --}}
                            @foreach ($allergicIngredients as $ingredient)
                                <li class="">{{ $ingredient->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Got it</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($allergicIngredients->count())
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                document.getElementById('triggerAllergyModal').click();
            });
        </script>
    @endif

    <section class="ftco-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <img src="{{ asset($product->image) }}" class="img-fluid">
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>
                    @php
                        $rating = round($product->rating, 1);
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - ($fullStars + $halfStar);
                    @endphp

                    <div class="rating d-flex gap-3">
                        <p class="text-left mr-4 mb-0">
                            <span class="mr-2">{{ number_format($product->rating, 2) }}</span>

                        <div class="rating text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->rating)
                                    <i class="fas fa-star"></i>
                                @elseif ($i == ceil($product->rating))
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        </p>

                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;"> {{ $product->reviews_count }} <span
                                    style="color: #bbb;"> Reviews</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{ $total }} <span
                                    style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>

                    {{--
                    @php
                        $hasActiveDiscount = false;
                        if ($product->discount > 0 && !empty($product->discount_start) && !empty($product->discount_end)) {
                            try {
                                $start = \Carbon\Carbon::parse($product->discount_start);
                                $end = \Carbon\Carbon::parse($product->discount_end);

                                if ($start && $end) {
                                    $hasActiveDiscount = now()->between($start, $end);
                                }
                            } catch (Exception $e) {
                                $hasActiveDiscount = false;
                            }
                        }
                    @endphp --}}

                    <p class="price">
                        @if (null)
                            <span class="text-danger">
                                ${{ number_format($product->price - $product->price * ($product->discount / 100), 2) }}
                            </span>
                            <del class="text-muted">${{ number_format($product->price, 2) }}</del>
                        @else
                            <span>${{ number_format($product->price, 2) }}</span>
                        @endif
                    </p>

                    <p>{{ $product->description }}</p>

                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" onclick="">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number"
                                value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">{{ $product->stock_quantity }} piece available</p>
                        </div>
                    </div>
                    <p class="text-end"><a href="javascript:void(0)" class="btn btn-success py-3 px-5 mr-2 add-to-cart-btn"
                            data-id="{{ $product->id }}">Add to Cart</a>

                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
                            href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                            aria-selected="true">Description</a>

                        <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                            role="tab" aria-controls="v-pills-2" aria-selected="false">Manufacturer</a>

                        <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3"
                            role="tab" aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                    </div>
                </div>
                <div class="col-md-12 tab-wrap">

                    <div class="tab-content bg-light" id="v-pills-tabContent">

                        {{-- Description Tab --}}
                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                            aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4">{{ $product->name }}</h3>

                                {{-- Display Price --}}
                                <p class="price">
                                    @if ($product->isDiscountActive())
                                        <span class="text-danger">
                                            ${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                        </span>
                                        <del class="text-muted">${{ number_format($product->price, 2) }}</del>
                                    @else
                                        <span>${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </p>

                                {{-- Product Information --}}
                                <p>{{ $product->description }}</p>

                                {{-- Ingredients Section --}}
                                @if ($product->ingredients->isNotEmpty())
                                    <h4 class="mt-4">Ingredients</h4>
                                    <ul>
                                        @foreach ($product->ingredients as $ingredient)
                                            <li>{{ $ingredient->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Barcode and Expiration Date --}}
                                <h4 class="mt-4">Product Information</h4>
                                <ul>
                                    <li><strong>Barcode:</strong> {{ $product->barcode ?? 'Not specified' }}</li>
                                    <li><strong>Expiration Date:</strong>
                                        {{ $product->expiration_date ? $product->expiration_date : 'Not specified' }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Manufacturer Info Tab --}}
                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">Manufactured By: {{ $product->brand ?? 'Unknown Brand' }}</h3>

                                <ul>
                                    <li><strong>Brand:</strong> {{ $product->brand ?? 'Not specified' }}</li>
                                    <li><strong>Weight:</strong> {{ $product->weight ?? 'Not specified' }} Kg</li>
                                    <li><strong>Dimensions:</strong> {{ $product->dimensions ?? 'Not specified' }}</li>
                                    <li><strong>Aisle:</strong> {{ $product->aisle ?? 'Not specified' }}</li>
                                    <li><strong>Section:</strong> {{ $product->section ?? 'Not specified' }}</li>
                                    <li><strong>Floor:</strong> {{ $product->floor ?? 'Not specified' }}</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Reviews Tab --}}
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                            <div class="row p-4">
                                <div class="col-md-7">
                                    <h3 class="mb-4">{{ $product->reviews_count }} Reviews</h3>

                                    @forelse ($product->reviews as $review)
                                        <div class="review mb-4">
                                            <div class="user-img" style="background-image: url(images/person_1.jpg); "
                                                style="object-fit: cover;">
                                            </div>
                                            <div class="desc">
                                                <h4>
                                                    <span
                                                        class="text-left">{{ $review->user->name ?? 'Anonymous' }}</span>
                                                    <span
                                                        class="text-right">{{ $review->created_at->format('d M Y') }}</span>
                                                </h4>
                                                <p class="star">
                                                <div class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="fas fa-star"></i>
                                                        @elseif ($i == ceil($review->rating))
                                                            <i class="fas fa-star-half-alt"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                </p>
                                                <p>{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No reviews yet. Be the first to review this product!</p>
                                    @endforelse
                                </div>
                                <div class="col-md-5">
                                    <div class="rating-wrap p-4 bg-white rounded shadow-sm">
                                        <h3 class="mb-4">Leave a Review</h3>

                                        <!-- Review Form -->
                                        <form id="review-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                            <div class="form-group">
                                                <label for="rating" class="font-weight-bold">Rating</label>
                                                <select name="rating" class="form-control" required>
                                                    <option value="" disabled selected>Select Rating</option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                            Star{{ $i > 1 ? 's' : '' }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="comment" class="font-weight-bold">Your Review</label>
                                                <textarea name="comment" class="form-control" rows="4" placeholder="Write your review here..." required></textarea>
                                            </div>

                                            <div class="form-group mt-4 text-right">
                                                <button type="button" class="btn btn-success px-4 py-2"
                                                    id="submit-review-btn">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- recommended products section --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Recommended Products</h2>
                    <p>Check out these products you might like.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($recommendedProducts as $recommended)
                    <div class="col-md-3 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url('{{ asset($recommended->image) }}');">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="javascript:void(0);"
                                            class="add-to-cart-btn d-flex align-items-center justify-content-center"
                                            data-id="{{ $recommended->id }}">
                                            <span class="flaticon-shopping-bag"></span></a>
                                        <a href="javascript:void(0)" onclick="addToWsihList({{ $recommended->id }})"
                                            class="d-flex align-items-center justify-content-center"
                                            data-product-id="{{ $recommended->id }}">
                                            <span class="flaticon-heart"></span></a>
                                        <a href="{{ route('product.show', $recommended->id) }}"
                                            class="d-flex align-items-center justify-content-center">
                                            <span class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                <span class="category"><a href="#">{{ $recommended->category->name }}</a></span>
                                <h2>{{ $recommended->name }}</h2>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $recommended->rating)
                                            <i class="fas fa-star"></i>
                                        @elseif ($i == ceil($recommended->rating))
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="sale">{{ $recommended->discount }}% Off</span>
                                <p class="mb-0">
                                    <span class="price price-sale">$
                                        {{ number_format($recommended->price, 2) }}</span>
                                    <span class="price">$
                                        {{ number_format($recommended->price * (1 - $recommended->discount / 100), 2) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#submit-review-btn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#review-form').serialize(); // Get form data

                $.ajax({
                    url: "{{ route('reviews.store', ['id' => $product->id]) }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            showMessage('Review submitted successfully!',
                                '#4CAF50'); // Green for success
                            $('#review-form')[0].reset(); // Reset the form
                            $('#reviews-section').prepend(response
                                .reviewHtml); // Optionally update reviews list dynamically
                        } else {
                            showMessage('Failed to submit the review. Please try again.' +
                                response,
                                '#F44336'); // Red for error
                        }
                    },
                    error: function(xhr) {
                        showMessage('Failed to submit the review. Please try again.' + xhr
                            .responseText,
                            '#F44336'); // Red for error
                        console.log('Error: ' + xhr.responseText);
                    }
                });
            });

            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault();
                var product_id = $(this).data('id');
                var quantity = $('#quantity').val();

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log(response);

                        showMessage(response.success, '#4CAF50');
                        $('#cart-count').text(response
                            .totalItems); // Update the cart count dynamically
                    },
                    error: function(xhr) {
                        console.log('Error: ' + xhr.responseText);
                        showMessage('Failed to add the product to the cart. Please try again.',
                            '#F44336');
                    }
                });
            });

            // Quantity Increment & Decrement
            $('.quantity-right-plus').off('click').on('click', function() {
                var quantity = parseInt($('#quantity').val());
                $('#quantity').val(quantity + 1);
            });

            $('.quantity-left-minus').off('click').on('click', function() {
                var quantity = parseInt($('#quantity').val());
                if (quantity > 1) {
                    $('#quantity').val(quantity - 1);
                }
            });
        });
    </script>
@endpush
