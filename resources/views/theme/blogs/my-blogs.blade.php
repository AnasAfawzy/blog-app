@extends('theme.master')
@section('title', 'Add New Blog')
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
                    @if (session('delete_blog_status'))
                        <div class="alert alert-danger">
                            {{ session('delete_blog_status') }}
                        </div>
                    @endif
                    @if (count($blogs) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ route('blogs.show', ['blog' => $blog]) }}"
                                                target="_blank">{{ $blog->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('blogs.edit', ['blog' => $blog]) }}"
                                                class="btn btn-sm btn-primary mr-2">Edit
                                            </a>
                                            <form id="delete_form" action="{{ route('blogs.destroy', ['blog' => $blog]) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <a href="javascript:document.getElementById('delete_form').submit();"
                                                    class="btn btn-sm btn-danger mr-2">delete
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $blogs->render('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
