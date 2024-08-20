@extends('theme.master')
@section('title', 'Register')
@section('content')
    <!--================ Hero sm banner start =================-->
    <section class="mb-5px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Add New Blog</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm banner end =================-->
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form enctype="multipart/form-data" action="{{ route('blogs.store') }}" class="form-contact contact_form"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="name" id="name" type="text"
                                placeholder="Enter your blog title" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="image" id="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <select class="form-control border" name="category_id" id="category_id"
                                value="{{ old('category_id') }}">
                                <option value="">Select Cateory</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <textarea class="w-100 border" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
