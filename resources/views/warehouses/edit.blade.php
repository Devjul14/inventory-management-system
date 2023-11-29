@extends('layouts.dashboard')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                        Edit Warehouse
                    </h1>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image -->
                        <img class="img-account-profile mb-2" src="{{ $warehouse->photo ? asset('storage/warehouses/'.$warehouse->photo) : asset('assets/img/demo/user-placeholder.svg') }}" alt="" id="image-preview" />
                        <!-- Profile picture help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Profile picture input -->
                        <input class="form-control form-control-solid mb-2 @error('photo') is-invalid @enderror" type="file"  id="image" name="photo" accept="image/*" onchange="previewImage();">
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Customer Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Warehouse Details
                    </div>
                    <div class="card-body">
                    <div class="mb-3">
                            <label class="small mb-1" for="warehouse_name">Warehouse Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name" type="text" placeholder="" value="{{ old('warehouse_name',$warehouse->warehouse_name) }}" />
                            @error('warehouse_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (location address) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="location">Location <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('location') is-invalid @enderror" id="location" name="location" type="text" placeholder="" value="{{ old('location',$warehouse->location) }}" />
                            @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (Size Capacity) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="size_capacity">Size Capacity <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('size_capacity') is-invalid @enderror" id="size_capacity" name="size_capacity" type="text" placeholder="" value="{{ old('size_capacity',$warehouse->size_capacity) }}" />
                                @error('size_capacity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                        </div>
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('warehouses.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Customer Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush
