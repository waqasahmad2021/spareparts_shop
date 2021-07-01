@extends('admin_view.app-inc.templatebody')

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Attach CSV File</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="file">Select CSV file from here.</label>
                                        <input type="file" id="file" class="form-control" placeholder="CSV File" name="file">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">CSV</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
