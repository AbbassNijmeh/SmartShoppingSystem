@extends('layouts.app')

@php
    use Illuminate\Support\Str;

@endphp

@section('body')
    <div class="hero-wrap" style="background-image: url({{ asset('assets/img/bg-2.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="mb-4">Good <span>products</span> for Good <span>Moments</span>.</h1>

                        <p class="mt-3">
                            <button class="btn btn-outline-light" id="scanBarcodeTrigger">
                                <i class="fa fa-barcode me-2"></i> Scan Barcode
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="scanModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.7); justify-content:center; align-items:center; z-index:100;">
        <div style="background:white; padding:20px; border-radius:10px; text-align:center; position:relative;">
            <h2 class="p-2">Welcome To Our Store!</h2>
            <p class="p-2">Scan your product to see details</p>
            <button id="startScanBtn"
                style="padding:10px 20px; background-color: #4CAF50; color:white; border:none; border-radius:5px;">
                Start Scanning
            </button>
            <div class="barcode-scanner-view" id="reader" style="width:300px; margin-top:20px; display:none;"></div>
            <button id="stopScanBtn"
                style="display: none; position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);"
                class="btn btn-danger mt-3">
                Stop Scanning
            </button>
            <div id="product-details" style="margin-top:20px;"></div>
            <button id="closeModal"
                style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:20px;">&times;</button>
        </div>
    </div>
    <hr>
    <div class="container-fluid" style="background-color: white !important; ">

        <!-- Offer Section -->
        <section class="offer-section">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <h2 class="text-gradient">Special Offers</h2>
                    <p class="lead">Discover our exclusive packages and special deals tailored just for you</p>
                </div>

                <div class="row">


                    @foreach ($offersproducts as $offer)
                        @php
                            $now = now();
                            $hasDiscount =
                                $offer->discount > 0 &&
                                $offer->discount_start !== null &&
                                $offer->discount_end !== null &&
                                $offer->discount_start <= $now &&
                                $offer->discount_end >= $now;
                        @endphp

                        <div class="col-md-4 mb-4">
                            <div class="offer-card">
                                @if ($hasDiscount)
                                    <div class="offer-badge">{{ $offer->discount }}% OFF</div>
                                @endif

                                <div class="" style="background: #4CAF50;">
                                    <img src="{{ asset($offer->image) }}" alt="{{ $offer->name }}"
                                        class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>

                                <div class="text-center p-4">
                                    <h3>{{ Str::limit($offer->name, 20, '...') }}</h3>
                                    <p>{{ $offer->description }}</p>

                                    @if ($hasDiscount)
                                        <div class="offer-price">
                                            <span class="text-danger">
                                                ${{ number_format($offer->price * (1 - $offer->discount / 100), 2) }}
                                            </span>
                                            <del class="text-muted ml-2">${{ number_format($offer->price, 2) }}</del>
                                        </div>
                                    @else
                                        <div class="offer-price">${{ number_format($offer->price, 2) }}</div>
                                    @endif

                                    <a href="{{ route('product.show', $offer->id) }}" class="offer-btn">View Offer</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    </div>

    <!-- Updated Category Slider Section -->
    <section class="py-5 overflow-hidden">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">Category</h2>

                        <div class="d-flex align-items-center">
                            <a href="{{ route('products') }}" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="category-carousel swiper">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $category)
                                <a class="nav-link swiper-slide text-center">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="rounded-circle"
                                        alt="{{ $category->name }} Thumbnail" />
                                    <h4 class="fs-6 mt-3 fw-normal category-title">{{ $category->name }}</h4>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section -->
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Our Delightful offerings</span>
                    <h2>Tastefully Yours</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    @php
                        $now = now();
                        $hasDiscount =
                            $product->discount > 0 &&
                            $product->discount_start !== null &&
                            $product->discount_end !== null &&
                            $product->discount_start <= $now &&
                            $product->discount_end >= $now;
                    @endphp

                    <div class="col-md-3 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url('{{ asset($product->image) }}');">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="javascript:void(0);"
                                            class="add-to-cart-btn d-flex align-items-center justify-content-center"
                                            data-id="{{ $product->id }}">
                                            <span class="flaticon-shopping-bag"></span></a>
                                        <a href="javascript:void(0)" onclick="addToWsihList({{ $product->id }})"
                                            class="d-flex align-items-center justify-content-center"
                                            data-product-id="{{ $product->id }}">
                                            <span class="flaticon-heart"></span></a>
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="d-flex align-items-center justify-content-center">
                                            <span class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>

                            <div class="text text-center">
                                <span class="category"><a href="#">{{ $product->category->name }}</a></span>
                                <h2>{{ $product->name }}</h2>

                                <div class="rating">
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

                                @if ($hasDiscount)
                                    <span class="sale">{{ $product->discount }}% Off</span>
                                    <p class="mb-0">
                                        <span class="price price-sale">${{ number_format($product->price, 2) }}</span>
                                        <span class="price">
                                            ${{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                        </span>
                                    </p>
                                @else
                                    <p class="mb-0">
                                        <span class="price">${{ number_format($product->price, 2) }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row justify-content-center py-2">
                <div class="col-md-4">
                    <a href="{{ route('products') }}" class="btn btn-primary d-block">View All Products
                        <span class="fa fa-long-arrow-right"></span></a>
                </div>
            </div>
        </div>



    </section>
    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="modalProductImage" src="" class="img-fluid rounded" style="max-height: 200px;"
                            alt="Product Image">
                    </div>

                    <h5 id="modalProductName" class="text-center mb-2">Product Name</h5>

                    <p id="modalProductPrice" class="text-center fs-5 fw-bold text-primary">$0.00</p>

                    <p id="modalProductReviews" class="text-center text-muted small">0 reviews</p>

                    <p id="modalProductIngredients" class="text-center mt-3">
                        <strong>Ingredients:</strong> None
                    </p>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addToCartFromModal" class="btn btn-primary" data-product-id="">Add to Cart</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function addToWsihList(id) {
            $.ajax({
                url: "{{ route('wishlist.store') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    let color = '#4CAF50'; // Default color for success
                    let message = response.message;

                    // Change color based on response type
                    if (response.type === 'cart') {
                        color = '#2196F3'; // Blue for cart
                        message = 'Product successfully added to your cart!';
                    } else if (response.type === 'info') {
                        color = '#FFC107'; // Amber for already in wishlist
                        message = 'Product is already in your wishlist.';
                    }
                    updateWishListPreview(response);
                    showMessage(message, color); // Display a success message
                },
                error: function(xhr) {
                    console.log('Error: ' + xhr.responseText);
                    showMessage('Oops! Something went wrong. Please try again later.',
                        '#F44336'); // Red for error
                }
            });
        }

        // Add to Cart button click event
        $('.add-to-cart-btn').click(function(e) {
            e.preventDefault();

            var product_id = $(this).data('id');
            var quantity = 1; // Quantity is always 1 for this setup

            // AJAX request to add the product to the cart
            $.ajax({
                url: "{{ route('cart.add') }}", // Route to the cart add method
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for security
                    product_id: product_id,
                    quantity: quantity // Always send quantity as 1
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart quantity in the cart dropdown

                        // Update the cart count in the navbar
                        showMessage('Product added to cart successfully!',
                            '#4CAF50'); // Green for success
                        updateCartPreview(response);

                    } else {
                        showMessage(
                            'Failed to add the product to the cart. Please try again.',
                            '#F44336'); // Red for error
                    }
                },
                error: function(xhr) {
                    // Handle error
                    showMessage('Oops! Something went wrong. Please try again later.',
                        '#F44336'); // Red for error
                }
            });
        });
        let scanner;

        document.getElementById('scanBarcodeTrigger').addEventListener('click', function() {
            document.getElementById('scanModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('scanModal').style.display = 'none';
            stopScanner();
        });




        $('#addToCartFromModal').on('click', function() {
            const productId = $(this).data('product-id');

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        showMessage('Product added to cart!', '#4CAF50');
                        $('#productDetailModal').removeClass('show').css('display', 'none');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        updateCartPreview(response);
                        // Ensure response contains cartCount and cartItems

                    } else {
                        showMessage('Failed to add to cart.', '#F44336');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        // Redirect to login with error message
                        window.location.href =
                            "/login?error=Please+login+to+add+items+to+your+cart";
                    } else {
                        showMessage('Error adding to cart.', '#F44336');
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/dynamsoft-barcode-reader-bundle@10.5.3000/dist/dbr.bundle.js"></script>
    <script>
        // Initialize license and core module
        Dynamsoft.License.LicenseManager.initLicense(
            "DLS2eyJoYW5kc2hha2VDb2RlIjoiMTA0MDQyNzA5LVRYbFhaV0pRY205cSIsIm1haW5TZXJ2ZXJVUkwiOiJodHRwczovL21kbHMuZHluYW1zb2Z0b25saW5lLmNvbSIsIm9yZ2FuaXphdGlvbklEIjoiMTA0MDQyNzA5Iiwic3RhbmRieVNlcnZlclVSTCI6Imh0dHBzOi8vc2Rscy5keW5hbXNvZnRvbmxpbmUuY29tIiwiY2hlY2tDb2RlIjotMTE2NjYwMzAyOH0="
        );
        Dynamsoft.Core.CoreModule.loadWasm(["dbr"]);

        let cvRouter, cameraEnhancer, cameraView;

        document.getElementById('startScanBtn').addEventListener('click', async function() {
            document.getElementById('reader').style.display = 'block';

            try {
                document.getElementById('startScanBtn').style.display = 'none';
                // Create instances
                cvRouter = await Dynamsoft.CVR.CaptureVisionRouter.createInstance();
                cameraView = await Dynamsoft.DCE.CameraView.createInstance();
                cameraEnhancer = await Dynamsoft.DCE.CameraEnhancer.createInstance(cameraView);

                // Add camera view to reader element
                document.getElementById('reader').append(cameraView.getUIElement());
                cvRouter.setInput(cameraEnhancer);

                // Configure result handling
                cvRouter.addResultReceiver({
                    onCapturedResultReceived: (result) => {
                        if (result.barcodeResultItems?.length > 0) {
                            handleBarcode(result.barcodeResultItems[0].text);
                        }
                    }
                });

                // Add multi-frame filter for better accuracy
                const filter = new Dynamsoft.Utility.MultiFrameResultCrossFilter();
                filter.enableResultCrossVerification("barcode", true);
                filter.enableResultDeduplication("barcode", true);
                await cvRouter.addResultFilter(filter);

                // Start camera and scanning
                await cameraEnhancer.open();
                await cvRouter.startCapturing("ReadSingleBarcode");
            } catch (error) {
                console.error("Scanner error:", error);
                alert("Camera access failed: " + error.message);
                stopScanner();
            }
        });

        async function stopScanner() {
            try {
                if (cvRouter) {
                    await cvRouter.stopCapturing();
                    cvRouter = null;
                }
                if (cameraEnhancer) {
                    cameraEnhancer.close(); // This is synchronous, no await needed
                    cameraEnhancer = null;
                    cameraView = null;
                }

                // Clean up UI
                document.getElementById('reader').innerHTML = '';
                document.getElementById('stopScanBtn').style.display = 'none';
                document.getElementById('startScanBtn').style.display = 'block';
            } catch (error) {
                console.error("Stop scanner error:", error);
            }
        }

        async function handleBarcode(decodedText) {
            try {
                if (cvRouter) cvRouter.stopCapturing();
                if (cameraEnhancer) cameraEnhancer.close();

                document.getElementById('reader').innerHTML = '';
                document.getElementById('stopScanBtn').style.display = 'none';
                document.getElementById('startScanBtn').style.display = 'block';
                await stopScanner();
                document.getElementById('scanModal').style.display = 'none';
                document.getElementById('scanModal').style.display = 'none';

                $.ajax({
                    url: "/api/product-by-barcode",
                    method: "GET",
                    data: {
                        barcode: decodedText
                    },
                    success: function(product) {
                        console.log("Scanned Barcode:", decodedText);

                        if (!product) {
                            showMessage("Product not found", "#F44336");
                            return;
                        }
                        //log the scanned text
                        // Update product modal with retrieved data
                        $('#modalProductImage').attr('src', product.image_url);
                        $('#modalProductName').text(product.name);

                        if (product.discounted_price) {
                            $('#modalProductPrice').html(
                                `<span class="text-danger">$${parseFloat(product.discounted_price).toFixed(2)}</span>
                         <del class="text-muted ml-2">$${parseFloat(product.price).toFixed(2)}</del>`
                            );
                        } else {
                            $('#modalProductPrice').html(`$${parseFloat(product.price).toFixed(2)}`);
                        }

                        $('#addToCartFromModal').data('product-id', product.id);
                        $('#modalProductReviews').html(product.reviews_count !== undefined ?
                            `<small class="text-muted">${product.reviews_count} reviews</small>` : '');

                        $('#modalProductIngredients').html(
                            product.ingredients?.length > 0 ?
                            `<strong>Ingredients:</strong> ${product.ingredients.join(', ')}` :
                            `<strong>Ingredients:</strong> None`
                        );

                        new bootstrap.Modal(document.getElementById('productDetailModal')).show();
                    },
                    error: function() {
                        showMessage("Failed to fetch product details", "#F44336");
                    }
                });
            } catch (error) {
                console.error("Cleanup error:", error);
            }
        }
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.category-carousel', {
                slidesPerView: 3,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.category-carousel-next',
                    prevEl: '.category-carousel-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        /* Offer Section Styles */
        .offer-section {
            padding: 80px 0;
            background-color: #f9fafc;
        }

        .offer-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .offer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .offer-icon {
            width: 70px;
            height: 70px;
            background: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 28px;
        }

        .offer-card h3 {
            font-size: 22px;
            color: #2a2a2a;
            margin-bottom: 15px;
        }

        .offer-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .offer-price {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .offer-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
            font-weight: 500;
            margin-top: auto;
        }

        .offer-btn:hover {
            background: #45a049;
            color: white;
            text-decoration: none;
        }

        .offer-badge {
            position: absolute;
            top: 20px;
            right: -40px;
            background: #ff4d4d;
            color: white;
            padding: 8px 40px;
            transform: rotate(45deg);
            font-size: 14px;
            font-weight: bold;
        }

        .text-gradient {
            background: linear-gradient(45deg, #4CAF50, #2196F3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (max-width: 768px) {
            .offer-card {
                margin-bottom: 30px;
            }

            .section-header h2 {
                font-size: 28px;
            }
        }

        /* Hero Section */
        .hero-wrap {
            background-size: cover;
            background-position: center;
            position: relative;
            color: #ffffff;
        }

        .hero-wrap .overlay {
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-wrap h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .hero-wrap .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .hero-wrap .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .hero-wrap .btn-outline-white {
            color: #ffffff;
            border-color: #ffffff;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .hero-wrap .btn-outline-white:hover {
            color: #007bff;
            background-color: #ffffff;
        }

        /* Modal Styling */
        #scanModal {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
        }

        #scanModal h2 {
            color: #007bff;
            font-weight: bold;
        }

        #scanModal button {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #scanModal button:hover {
            transform: scale(1.1);
        }



        /* Filter Row */
        .card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .card .form-control {
            border-radius: 0.25rem;
        }

        .card .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .card .btn-primary:hover {
            background-color: #218838;
        }

        .card .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        .card .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #ffffff;
        }

        /* Category Section */
        .sort {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sort:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sort h6 {
            color: #007bff;
            font-weight: bold;
        }

        /* Product Section */
        .product {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product .text h2 {
            font-size: 1.25rem;
            color: #343a40;
        }

        .product .text .price {
            color: #28a745;
            font-weight: bold;
        }

        .product .text .price-sale {
            color: #dc3545;
            text-decoration: line-through;
        }

        .product .rating i {
            color: #ffc107;
        }

        /* Modal Enhancements */
        .modal-header {
            background-color: #007bff;
            color: #ffffff;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Swiper Styles */
        .swiper-container {
            width: 100%;
            padding: 20px 0;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category-card {
            text-align: center;
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .category-name {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        /* New Category Section Styles */
        .category-carousel .swiper-slide {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .category-carousel img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .category-title {
            color: #333;
        }
    </style>
@endpush
