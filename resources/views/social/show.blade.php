@extends("layouts.app")

@section("title", "Display $provider Info")

@section("content")
    <div class="row">
        <div class="col-12">
            <h1>{{ ucfirst($provider) }} Information</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Attribute</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $attribute_key => $attribute_value)
                    <tr>
                        <th scope="row">{{ ucfirst($attribute_key) }}</th>
                        <td>{{ $attribute_value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
