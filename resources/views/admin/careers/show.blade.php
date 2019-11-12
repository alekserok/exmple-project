@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Career {{ $career->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/careers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/careers/' . $career->id . '/edit') }}" title="Edit Career"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/careers', $career->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Career',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $career->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Type </th><td> {{ \App\Career::$types[$career->type] }} </td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $career->name }} </td></tr>
                                    <tr><th> Age </th><td> {{ $career->age }} </td></tr>
                                    <tr><th> Visa Status </th><td> {{ $career->visa_status }} </td></tr>
                                    <tr><th> Nationality </th><td> {{ $career->nationality }} </td></tr>
                                    <tr><th> Language </th><td> {{ $career->language }} </td></tr>
                                    <tr><th> Contacts </th><td> {{ $career->contacts }} </td></tr>
                                    <tr><th> Socials </th><td> {{ $career->socials }} </td></tr>
                                    <tr>
                                        <th> Attachment </th>
                                        <td>
                                            @if($career->attachment)
                                                <a href="/storage/{{ $career->attachment }}" download >Download</a>
                                            @else
                                                No set
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
